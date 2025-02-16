import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

console.log('ENV VARIABLES:', process.env);

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',           // Main CSS file
                'resources/css/components/navbar.css', // Add navbar.css
                'resources/css/components/footer.css', // Add footer.css
                'resources/js/app.js',             // JS file
            ],
            refresh: true,
        }),
    ],
    server: {
        host: 'localhost',
        port: 5173, // Default port for Vite
    },
});
