//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

window.Vue = require('vue').default;

import Movies from './components/Movies'
import Index from './components/Index'
import AddMovie from './components/AddMovie'
import SubmitMovie from './components/SubmitMovie'

import VueRouter from 'vue-router'

import Vuex from "vuex"

Vue.use(VueRouter).use(Vuex)

const routes = [{
        path: '/movies',
        name: 'Movies',
        component: Movies,
        components: {
            'Movies': Movies
        }
    },
    {
        path: '/',
        name: 'Index',
        component: Index,
    },
    {
        path: '/movies/search',
        name: 'AddMovie',
        component: AddMovie,
    },
    {
        path: '/movies/add/:id?',
        name: 'SubmitMovie',
        component: SubmitMovie,
    }
];

const router = new VueRouter({
    routes,
    //linkActiveClass: "active",
    linkExactActiveClass: "active",
})

const app = new Vue({
    el: '#dashboard',
    router,
});