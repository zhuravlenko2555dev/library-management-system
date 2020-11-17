import Vue from 'vue';
import Vuex from 'vuex';

import auth from './auth';

Vue.use(Vuex);

let store = new Vuex.Store({
    modules: {
        auth
    }
});

export default store;
