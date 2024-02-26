import { createApp, h } from 'vue'
import { ZiggyVue } from 'ziggy-vue';
import route from 'ziggy';
import { InertiaProgress } from '@inertiajs/progress'
import { createInertiaApp, Link } from '@inertiajs/vue3'
import '../css/app.css';
import VueToastr from 'vue-toastr'

createInertiaApp({
    resolve: async (name) => {
        const pages = import.meta.glob('./Pages/**/*.vue');

        return (await pages[`./Pages/${name}.vue`]()).default;
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .component('inertia-link', Link)
            .use(plugin)
            .mixin({
                methods: {
                    image_path(path) {
                        return this.settings.images + '/' + path;
                    },

                    isRouteActive(route) {
                        let currentRoute = window.location.href.replace(/\/$/, '');
                        return currentRoute == route;
                    },

                    // isLoggedIn() {
                    //     return this.$page.user;
                    // },

                    isPlayerLoggedIn() {
                        if (this.$page.props.user.role[0].key == 'player') {
                            return true;
                        }
                        return false;
                    },

                    isAdminLoggedIn() {
                        if (this.$page.props.user.role[0].key == 'admin') {
                            return true;
                        }
                        return false;
                    },

                    isParentLoggedIn() {
                        if (this.$page.props.user.role[0].key == 'parent') {
                            return true;
                        }
                        return false;
                    }
                }
            })
            .use(ZiggyVue)
            .mount(el)

        InertiaProgress.init()
    },
});