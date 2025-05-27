import '../css/app.css';
import './bootstrap';

import { createApp, h } from 'vue';
import { createInertiaApp, Head, Link } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import Antd from 'ant-design-vue';
import 'ant-design-vue/dist/reset.css';
import VueApexCharts from "vue3-apexcharts";

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue'),
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(Antd)
            .use(VueApexCharts)
            .component('Head', Head)
            .component('Link', Link)
            .mount(el);
    },
     progress: {
    delay: 250,
    color: '#F13',
    includeCSS: true,
    showSpinner: false,
  },
});
