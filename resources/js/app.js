/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// AdminLTE App
require('admin-lte');

// OverlayScrollbars
require('admin-lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js');

// FLOT CHARTS
require('admin-lte/plugins/flot/jquery.flot.js');

window.Vue = require('vue');

import router from './router';
import store from './store';
import Application from './Application';

import Panel from "./layouts/Panel";
import Empty from "./layouts/Empty";

import Notifications from 'vue-notification';
import VueBreadcrumbs from 'vue-2-breadcrumbs';

Vue.component('panel-layout', Panel);
Vue.component('empty-layout', Empty);

Vue.use(Notifications);
Vue.use(VueBreadcrumbs, {
    template:
        '<ol class="breadcrumb float-sm-right">\n' +
        '    <li :class="{\'active\': key == $breadcrumbs.length - 1}" v-for="(crumb, key) in $breadcrumbs" v-if="crumb.meta.breadcrumb" :key="key" class="breadcrumb-item" aria-current="page">\n' +
        '        <router-link v-if="key != ($breadcrumbs.length - 1)" :to="{ path: getPath(crumb) }">{{ getBreadcrumb(crumb.meta.breadcrumb) }}</router-link>' +
        '        <span v-else>{{ getBreadcrumb(crumb.meta.breadcrumb) }}</span>' +
        '    </li>\n' +
        '</ol>\n'
});

const access_token = localStorage.getItem('access_token');
if (access_token) {
    axios.defaults.headers.common['Authorization'] = 'Bearer ' + access_token;
}
axios.defaults.headers.common['Accept'] = 'application/json';
axios.defaults.headers.common['Content-Type'] = 'application/x-www-form-urlencoded';

axios.interceptors.response.use(undefined, function (err) {
    return new Promise(function (resolve, reject) {
        if (err.response.status === 401 && err.response.config && !err.response.config.__isRetryRequest) {
            this.$store.dispatch('auth_logout')
        }
    });
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    // el: '#app',
    router,
    store,
    render: h => h(Application)
}).$mount('#app');
