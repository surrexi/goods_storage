window.axios = require('axios');
import Vue from 'vue';

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import ProductsIndex from './components/products/ProductsIndex.vue';
import ProductsCreate from './components/products/ProductsCreate.vue';
import ProductsEdit from './components/products/ProductsEdit.vue';

const routes = [
    {path: '/', component: ProductsIndex, name: 'productsIndex'},
    {path: '/products/create', component: ProductsCreate, name: 'createProduct'},
    {path: '/products/edit/:id', component: ProductsEdit, name: 'editProduct'},
];

const router = new VueRouter({ routes });
new Vue({ router }).$mount('#app');
