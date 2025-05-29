import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    build: {
        outDir: 'public/build',
        chunkSizeWarningLimit: 1024,
        manifest: true,
        rollupOptions: {
            output: {
                manualChunks: undefined
            }
        }
    }
});
