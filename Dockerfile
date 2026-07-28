FROM php:8.3-cli-bookworm

# Install system dependencies termasuk GD libraries
RUN apt-get update && apt-get install -y \
    libgd-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libwebp-dev \
    libzip-dev \
    libicu-dev \
    git \
    curl \
    zip \
    unzip \
    && docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
        --with-webp \
    && docker-php-ext-install \
        gd \
        pdo \
        pdo_mysql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        zip \
        intl \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install Node.js 20
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy composer files dulu (cache layer)
COPY composer.json composer.lock ./

# Install PHP dependencies
RUN COMPOSER_ALLOW_SUPERUSER=1 composer install \
    --no-dev \
    --optimize-autoloader \
    --no-scripts \
    --no-interaction

# Copy package files
COPY package.json package-lock.json ./

# Install npm dependencies
RUN npm ci

# Copy semua file aplikasi
COPY . .

# Build assets (Vite)
RUN npm run build

# Jalankan post-autoload dump
RUN COMPOSER_ALLOW_SUPERUSER=1 composer dump-autoload --optimize

# Buat direktori yang dibutuhkan & set permission
RUN mkdir -p storage/framework/sessions \
              storage/framework/views \
              storage/framework/cache \
              storage/framework/testing \
              storage/logs \
              bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Buat storage symlink
RUN php artisan storage:link || true

EXPOSE 8080

# Start: cache config lalu jalankan server
CMD bash -c "php artisan config:cache && php artisan route:cache && php artisan view:cache && php artisan serve --host=0.0.0.0 --port=${PORT:-8080}"
