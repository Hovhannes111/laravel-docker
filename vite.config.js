import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0',  // Allow access from outside the container
        port: 3000,
        hmr: {
            host: 'localhost',  // Ensure HMR points to localhost for browser access
        },
        open: false
    },
});
