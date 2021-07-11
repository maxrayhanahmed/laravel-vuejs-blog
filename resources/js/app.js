/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

require('admin-lte');
require('@fortawesome/fontawesome-free');


window.Vue = require('vue').default;

// import vuejs
import Vue from 'vue'

// import vue-router
import VueRouter from 'vue-router'

// import vform
import Form from 'vform'
import {
    Button,
    HasError,
    AlertError,
    AlertErrors,
    AlertSuccess
  } from 'vform/src/components/bootstrap4'
  // 'vform/src/components/tailwind'
  Vue.component(Button.name, Button)
  Vue.component(HasError.name, HasError)
  //Vue.component(AlertError.name, AlertError)
  //Vue.component(AlertErrors.name, AlertErrors)
  //Vue.component(AlertSuccess.name, AlertSuccess)


  // import vform
  //import Vue from 'vue';
  //import VueSweetalert2 from 'vue-sweetalert2';
  //Vue.use(VueSweetalert2);

window.From = Form;

Vue.use(VueRouter);


// import sweetalert2
import Swal from 'sweetalert2'
window.Swal = Swal;

// CommonJS
//const Swal = require('sweetalert2')

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })
  window.Toast = Toast;

  //import toastr

  import toastr from 'toastr';

  window.toastr = toastr;

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
import CKEditor from '@ckeditor/ckeditor5-vue2';

Vue.use( CKEditor );


  Vue.use(Vuex)

const store = new Vuex.Store(storeData)



 const app = new Vue({
    el: '#app',
    router,
    store
})//.$mount('#app')

