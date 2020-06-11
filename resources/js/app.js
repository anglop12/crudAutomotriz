import Vue from 'vue';
import router from './router';
import store from './store'
import App from './components/App';

import VueAxios from 'vue-axios';
import axios from 'axios';

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

require('./bootstrap');

Vue.use(router);
Vue.use(store);

store.dispatch('getUser');

Vue.use(VueAxios, axios);
// Install BootstrapVue
Vue.use(BootstrapVue);
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin);

// router.beforeEach((to, from, next) => {
    
//     if (to.matched.some(record => record.meta.requiresAuth)) {
//         // alert();
//         // this route requires auth, check if logged in
//         // if not, redirect to login page.
//         if (!store.state.auth) {
//                 console.log('paso');
//             next({ name: 'login' })
//         } else {
//             next()
//         }
//     } else {
//         next() // make sure to always call next()!
//     }

// });
router.beforeEach((to, from, next) => {
    console.log('meta='+to.meta.requiresAuth)
    console.log('auth='+store.state.auth)
    if (to.meta.requiresAuth)
        if (!store.state.auth)
            setTimeout(function() {
                if(!store.state.auth) next({ name: 'login' })
                else next()
            }, 2000);
        else next()
    else next()
});

const app = new Vue({
    el: '#app',
    components: {
        App
    },
    router,
    store,
});
