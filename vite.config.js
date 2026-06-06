import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js',
                'resources/css/public-home.css',
                'resources/js/public-home.js',
                'resources/css/public-ppdb.css',
                'resources/js/public-ppdb.js'
            ],
            refresh: true,
        }),
    ],
});
