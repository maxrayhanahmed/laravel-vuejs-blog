/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 require('./bootstrap');


 window.Vue = require('vue').default;

 // import vuejs
 import Vue from 'vue'

 // import vue-router
 import VueRouter from 'vue-router'



 Vue.use(VueRouter);




   //import toastr


   // import momentjs
 import {filter} from './filters/filters'


 //////////////

 // 0. If using a module system (e.g. via vue-cli), import Vue and VueRouter
 // and then call `Vue.use(VueRouter)`.

 // 1. Define route components.
 // These can be imported from other files
 //const Foo = { template: '<div>foo</div>' }
 //const Bar = { template: '<div>bar</div>' }

 // 2. Define some routes
 // Each route should map to a component. The "component" can
 // either be an actual component constructor created via
 // `Vue.extend()`, or just a component options object.
 // We'll talk about nested routes later.


 import {routes} from './routes/routes';

 // 3. Create the router instance and pass the `routes` option
 // You can pass in additional options here, but let's
 // keep it simple for now.
 const router = new VueRouter({
   routes,
   //mode:"history"
 })




 // import vuex

 import Vuex from 'vuex'

 import storeData from './store/store';

 import {mixin} from './helpers/mixin';


   Vue.use(Vuex);

 const store = new Vuex.Store(storeData);

 // component for frontend


Vue.component('front-footer', require('./components/frontend/footer').default);
Vue.component('front-header', require('./components/frontend/header').default);
//Vue.component('front-sitebar', require('./components/frontend/sitebar').default);
Vue.component('front-master', require('./components/frontend/front-master').default);

Vue.component('pagination', require('laravel-vue-pagination'));

//Vue.component('home', require('./components/backend/home').default);

 const app = new Vue({
    el: '#app2',
    router,
    store
})//.$mount('#rayhaahmed')

