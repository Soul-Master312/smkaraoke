
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';
import ElementUI from 'element-ui';
import locale from 'element-ui/lib/locale/lang/en';
import router from  './routes/Router';
import currentLocale from  './locale';
import auth from  './auth';
import Trans from './lang';
import App from './components/AppComponent';

Vue.prototype.$locale = currentLocale;
Vue.prototype.$auth = auth;
Vue.use(ElementUI, { locale });
Vue.mixin(Trans);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    components: { App },
    router
});
