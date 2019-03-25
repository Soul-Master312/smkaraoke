import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        user: {},
        loggedIn: false,
        token: localStorage.getItem('token') || '',
        role: '',
    },
    getters: {
        isLoggedIn: state => !!state.token,
        token: state => state.token,
    },
    mutations: {
        auth_success: (state, data) => {
            state.token = data.token;
            state.user = data.user;
            state.loggedIn = true;
        },
        logout: (state) => {
            state.loggedIn = false;
            state.user = {};
            state.token = '';
            state.role = '';
        },
    },
    actions: {
        login: ({ commit }, data) => {
            return new Promise((resolve, reject) => {
                localStorage.setItem('token', data.token);
                window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + data.token;
                commit('auth_success', data);
                resolve();
            })

        },
        logout({commit}){
            return new Promise((resolve, reject) => {
                commit('logout');
                localStorage.removeItem('token');
                delete window.axios.defaults.headers.common['Authorization'];
                resolve();
            })
        }
    }
});