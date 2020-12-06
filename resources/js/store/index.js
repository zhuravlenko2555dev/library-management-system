import Vue from 'vue';
import Vuex from 'vuex';

import auth from './auth';
import dashboard from './dashboard';

Vue.use(Vuex);

let store = new Vuex.Store({
    modules: {
        auth,
        dashboard
    }
});

export default store;
