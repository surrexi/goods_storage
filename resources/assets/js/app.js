window.axios = require('axios');
import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);

import ProductsIndex from './components/products/ProductsIndex.vue';
import ProductCreate from './components/products/ProductCreate.vue';
import ProductEdit from './components/products/ProductEdit.vue';
import CellsIndex from './components/cells/CellsIndex.vue';
import CellShow from './components/cells/CellShow.vue';
import CellCreate from './components/cells/CellCreate.vue';
import CellEdit from './components/cells/CellEdit.vue';

const routes = [
    {path: '/', component: CellsIndex, name: 'startPage'},
    {path: '/cells', component: CellsIndex, name: 'cellsIndex'},
    {path: '/cell/:id/products', component: CellShow, name: 'showCell'},
    {path: '/cell/create', component: CellCreate, name: 'createCell'},
    {path: '/cell/edit/:id', component: CellEdit, name: 'editCell'},
    {path: '/products', component: ProductsIndex, name: 'productsIndex'},
    {path: '/product/create', component: ProductCreate, name: 'createProduct'},
    {path: '/product/edit/:id', component: ProductEdit, name: 'editProduct'},
];

const router = new VueRouter({ routes });
new Vue({ router }).$mount('#app');
