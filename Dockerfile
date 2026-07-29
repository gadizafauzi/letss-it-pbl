FROM php:8.4-apache

# Install dependencies dasar
RUN apt-get update && apt-get install -y --no-install-recommends \
    libzip-dev \
    libicu-dev \
    libonig-dev \
    git \
    curl \
    zip \
    unzip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions tanpa GD dulu
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    mbstring \
    bcmath \
    zip \
    intl \
    pcntl \
    exif

# Install GD dependencies terpisah
RUN apt-get update && apt-get install -y --no-install-recommends \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libwebp-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install GD extension terpisah
RUN docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
        --with-webp \
    && docker-php-ext-install gd

# Enable Apache mod_rewrite & ensure only mpm_prefork is loaded (avoiding overlayfs MPM bug)
RUN a2dismod mpm_event mpm_worker || true \
    && a2enmod mpm_prefork \
    && a2enmod rewrite

# Install Node.js 20
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y --no-install-recommends nodejs \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy composer files (cache layer)
COPY composer.json composer.lock ./

# Install PHP dependencies
RUN COMPOSER_ALLOW_SUPERUSER=1 composer install \
    --no-dev \
    --optimize-autoloader \
    --no-scripts \
    --no-interaction

# Copy package files & install npm
COPY package.json package-lock.json ./
RUN npm ci

# Copy semua file
COPY . .

# Build Vite assets
RUN npm run build

# Setup .env & key
RUN cp .env.example .env \
    && php artisan key:generate --force

# Setup storage & permissions
RUN mkdir -p storage/framework/sessions \
              storage/framework/views \
              storage/framework/cache \
              storage/logs \
              bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache

# Storage symlink
RUN php artisan storage:link || true

# Apache: arahkan ke /public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' \
        /etc/apache2/sites-available/000-default.conf \
    && echo '<Directory /var/www/html/public>\n    AllowOverride All\n    Require all granted\n</Directory>' \
        >> /etc/apache2/sites-available/000-default.conf

EXPOSE 80

CMD bash -c "php artisan config:clear && php artisan config:cache && php artisan migrate --force && php artisan route:cache && php artisan view:cache && apache2-foreground"
