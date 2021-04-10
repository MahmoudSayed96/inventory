require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

// Routes Imported.
import {routes} from './routes';

import {getEnv} from './AppEnv';
window.ENV = getEnv;

// Import User and make it global.
import User from './Helpers/User';
window.User = User;

const router = new VueRouter({
    routes,
    mode: 'history'
});

const app = new Vue({
    el: '#app',
    router,
});

