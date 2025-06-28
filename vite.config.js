import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/login.css',
                'resources/css/register.css',
                'resources/css/dashboard.css',
                'resources/js/app.js'
            ],
            refresh: true,
        }),
    ],
    host: 'localhost',
    hmr: {
      host: 'localhost',
    }
});
