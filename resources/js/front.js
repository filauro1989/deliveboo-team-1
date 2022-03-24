/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import App from './views/App.vue';
import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from './pages/Home.vue';

Vue.use(VueRouter);

const router = new VueRouter({
    // mode history serve per nn fare comparire il cancelletto alla fine dell'url nel browser
    mode: 'history',
    // attribuiamo alla rotta la classe active
    // linkExactActiveClass: 'active',
    // tutte le rotte a cui colleghiamo le pagine
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
        },
    ]
});

const app = new Vue({
    el: '#app',
    render: h => h(App),
    // nell'istanza di Vue usa pure le rotte di router
    router
});
