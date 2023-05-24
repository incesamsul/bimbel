import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

import '/resources/template/sbadmin/vendor/jquery/jquery.min.js';
import '/resources/template/sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js';
import '/resources/template/sbadmin/vendor/jquery-easing/jquery.easing.min.js';
import '/resources/template/sbadmin/js/sb-admin-2.min.js';
import '/resources/template/sbadmin/vendor/datatables/jquery.dataTables.min.js';
import '/resources/template/sbadmin/vendor/datatables/dataTables.bootstrap4.min.js';
import '/resources/template/sbadmin/vendor/ckeditor/build/ckeditor.js';
import '/resources/template/sbadmin/vendor/chart.js/chart.min.js';


const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .mount(el);
    },
    progress: {

        // The color of the progress bar...
        color: '#EC407A',

        // Whether to include the default NProgress styles...
        includeCSS: true,

        // Whether the NProgress spinner will be shown...
        showSpinner: true,
    },
    // ...
});

