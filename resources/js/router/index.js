import Vue from 'vue';
import VueRouter from 'vue-router';
import VueMeta from 'vue-meta'
import store from '../store';
import Dashboard from '../views/Dashboard'
import Login from '../views/Login'

Vue.use(VueRouter);
Vue.use(VueMeta)

let router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'dashboard',
            component: Dashboard,
            meta: {
                requiresAuth: true,
                breadcrumb: 'Dashboard',
                headerTitle: 'Dashboard'
            }
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
            meta: {
                layout: 'empty',
                requiresAuth: false
            }
        },
    ]
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (store.getters.isLoggedIn) {
            next();
            return;
        }
        next('/login' );
    } else if (to.matched.some(record => !record.meta.requiresAuth)) {
        if (!store.getters.isLoggedIn) {
            next();
            return;
        }
        next({ name: 'dashboard' });
    } else {
        next();
    }
})

export default router;
