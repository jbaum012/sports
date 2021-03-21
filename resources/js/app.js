require('./bootstrap');

// Import modules...
import { createApp, h } from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin, config } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';

const el = document.getElementById('app');

const app = createApp({
    render: () =>
        h(InertiaApp, {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: (name) => require(`./Pages/${name}`).default,
        }),
})
const root = app.mixin({ methods: { route } })
    .use(InertiaPlugin)
    .mount(el);
// load the laravel routes
app.config.globalProperties.$routes = route



InertiaProgress.init({ color: '#4B5563' });
