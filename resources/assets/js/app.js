
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';
import BootstrapVue from 'bootstrap-vue';
import store from './store/store';
import router from  './routes/Router';
import currentLocale from  './locale';
import firebase from  './firebase';
import Trans from './lang';
import App from './components/AppComponent';
import BaseConfig from './config';
import '../sass/custom.sass';
import VueYoutube from 'vue-youtube';

Vue.use(VueYoutube);
Vue.prototype.$locale = currentLocale;
Vue.prototype.$firebase = firebase;
Vue.prototype.$baseConfig = BaseConfig;
Vue.use(BootstrapVue);
Vue.mixin(Trans);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

window.app = new Vue({
    el: '#app',
    components: { App },
    store,
    router
});
