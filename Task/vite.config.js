import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/jquery.js',
                'resources/js/app.js',
                'resources/js/post/main.js',
                'resources/image/style.css',
            ],
            refresh: true,
        }),
    ],
});
