import './bootstrap'
import { createInertiaApp } from '@inertiajs/svelte'
import App from './Layouts/App.svelte'

createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob('./Pages/**/*.svelte', { eager: true })
        let page = pages[`./Pages/${name}.svelte`]
        return { default: page.default, layout: page.layout || App }
    },
    setup({ el, App, props }) {
        new App({ target: el, props })
    }
})
