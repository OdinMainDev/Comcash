import path from 'path';
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from 'tailwindcss'


export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.js', 'resources/js/comcash/main.ts', 'resources/js/comcash/main2.ts'],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
          '@': path.resolve(__dirname, 'resources/js/comcash')
        }
    },
    css: {
        postcss: {
          plugins: [tailwindcss],
        },
      },
});
