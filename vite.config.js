import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

console.log('ENV VARIABLES:', process.env);

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        host: 'localhost',
        port: 5173, // Default port for Vite
    },
});

 