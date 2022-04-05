/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import '@fortawesome/fontawesome-free/css/all.css';
import '@fortawesome/fontawesome-free/js/all.js'

window.Vue = require('vue');

import App from './views/App.vue';
import Vue from 'vue';
import VueRouter from 'vue-router';
import vueBraintree from 'vue-braintree';

Vue.use(vueBraintree);

import Home from './pages/Home.vue';
import Restaurant from './pages/Restaurant.vue';
import Checkout from './pages/Checkout.vue';

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
        {
            path: '/restaurant/:id',
            name: 'restaurant',
            props: true,
            component: Restaurant,
        },
        {
            path: '/checkout',
            name: 'checkout',
            props: true,
            component: Checkout,
        },
    ]
});

const app = new Vue({
    el: '#app',
    render: h => h(App),
    // nell'istanza di Vue usa pure le rotte di router
    router
});
