import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';
export default defineConfig({
    server: {
        hmr: {
            overlay: false
        },
        host: 'localhost',
        port: 5173
    },
    build:  {
        chunkSizeWarningLimit: 1500,
        rollupOptions: {
            output: {
                manualChunks: {
                    vendor: ['react', 'react-dom'],
                }
            }
        }
    },
    plugins: [
        laravel({
            input: [
                // 'resources/js/home/index.tsx',
            ],
            refresh: true,
        }),
        react()
    ],
    resolve: {
        extensions: ['.tsx, .ts', '.js', '.jsx']
    },
});
