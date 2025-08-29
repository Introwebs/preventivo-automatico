import './bootstrap';
import '../css/app.css';
import '../css/primevue.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import { Head, Link } from '@inertiajs/vue3';
import PrimeVue from 'primevue/config';
import Aura from '../../presets/aura';
import 'primeicons/primeicons.css';
import Tooltip from 'primevue/tooltip';
import ScrollTop from 'primevue/scrolltop';
import BackLink from '@/Components/BackLink.vue';
import ToastService from 'primevue/toastservice';
import { autoAnimatePlugin } from '@formkit/auto-animate/vue';

const appName = 'Preventivo Automatico';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(ToastService)
            .use(autoAnimatePlugin)
            .use(PrimeVue, {unstyled: true, pt: Aura})
            .component('Link', Link)
            .component('Head', Head)
            .component('ScrollTop', ScrollTop)
            .component('BackLink', BackLink)
            .directive('tooltip', Tooltip)
            .mount(el);
    },
    progress: false
});
