
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//
//Vue.component('example', require('./components/Example.vue'));

import example from './components/Example.vue';
import ElementUi from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css'
import router from './router';
import VueResource from 'vue-resource';

Vue.use(ElementUi);
Vue.use(VueResource);


Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name=csrf-token]').getAttribute('content');
Vue.http.interceptors.push(function (response,next){
	
	next(function (response){
		return response;
	});
})


    



const app = new Vue({
    el: '#app',
	router,
	components: { example }
});
