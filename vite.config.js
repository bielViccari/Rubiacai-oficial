import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/category-slide.js',
                'resources/js/show-navbar.js',
                'resources/js/show-sidebar.js'
            ],
            refresh: true,
        }),
    ],
});
