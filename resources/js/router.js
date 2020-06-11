import Vue from 'vue';
import Router from 'vue-router';
import HomeComponent from './components/HomeComponent';
import LoginComponent from './components/LoginComponent';
import ClientsComponent from './components/ClientsComponent';
import NotFound from './components/NotFound';
import ConcessionairesComponent from './components/ConcessionairesComponent';

Vue.use(Router);

export default new Router({
    mode: 'history',
    linkActiveClass: 'is-active',
    routes: [
        { path: '/login', name: 'login', component: LoginComponent, meta: {requiresAuth: false} },
        { path: '/', redirect: '/home', meta: {requiresAuth: true} },
        { path: '/home', name: 'home', component: HomeComponent, meta: {requiresAuth: true} },
        { path: '/clients', name: 'clients', component: ClientsComponent, meta: {requiresAuth: true} },
        { path: '/concessionaires', name: 'concessionaires', component: ConcessionairesComponent, meta: {requiresAuth: true} },
        { path: '/404', name: '404', component: NotFound, meta: {requiresAuth: false} },
        { path: '*', redirect: '/404', meta: {requiresAuth: false} },
    ]
});