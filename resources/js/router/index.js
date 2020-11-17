import Vue from 'vue';
import VueRouter from 'vue-router';
import VueMeta from 'vue-meta'
import store from '../store';
import Login from '../views/Login'

Vue.use(VueRouter);
Vue.use(VueMeta)

let router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'root',
            redirect: '/dashboard'
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
        {
            path: '/dashboard',
            name: 'dashboard',
            // component: Dashboard,
            meta: {
                requiresAuth: true
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
        next({ name: 'root' });
    } else {
        next();
    }
})

export default router;
