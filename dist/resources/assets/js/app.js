'use strict';

var _Example = require('./components/Example.vue');

var _Example2 = _interopRequireDefault(_Example);

var _elementUi = require('element-ui');

var _elementUi2 = _interopRequireDefault(_elementUi);

require('element-ui/lib/theme-chalk/index.css');

var _router = require('./router');

var _router2 = _interopRequireDefault(_router);

var _vueResource = require('vue-resource');

var _vueResource2 = _interopRequireDefault(_vueResource);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

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

Vue.use(_elementUi2.default);
Vue.use(_vueResource2.default);

Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name=csrf-token]').getAttribute('content');
Vue.http.interceptors.push(function (response, next) {

  next(function (response) {
    return response;
  });
});

var app = new Vue({
  el: '#app',
  router: _router2.default,
  components: { example: _Example2.default }
});
//# sourceMappingURL=app.js.map