import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';

axios.defaults.withCredentials = true;

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        user: null,
        auth: false,
    },
    mutations: {
        SET_USER(state, user) {
            state.user = user;
            state.auth = Boolean(user);
        }
    },
    actions: {
        async logout({ dispatch }) {
            axios.post('https://crudautomotriz.000webhostapp.com/logout').then(response => {
                dispatch("getUser")
            });
        },
        async login({ dispatch },credentials) {
            axios.get('https://crudautomotriz.000webhostapp.com/sanctum/csrf-cookie').then(response => {
                axios.post('https://crudautomotriz.000webhostapp.com/login', credentials).then(response => {
                    dispatch("getUser");
                });
            });
        },
        async getUser({ commit }) {
            await axios.get('https://crudautomotriz.000webhostapp.com/api/user')
            .then(response => {
                commit('SET_USER', response.data);
            })
            .catch(() => {
                commit('SET_USER', null);
            });
        }
    },
    modules: {},
});