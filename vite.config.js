import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import { svelte } from '@sveltejs/vite-plugin-svelte'

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/scss/app.scss', 'resources/js/app.js'],
            refresh: true
        }),
        svelte({
            compilerOptions: {
                hydratable: true
            }
            // inspector: {
            //     showToggleButton: 'always'
            // }
        })
    ],
    server: {
        hmr: {
            host: 'localhost'
        }
    }
})
