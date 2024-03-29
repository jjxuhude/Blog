'use strict';

Object.defineProperty(exports, "__esModule", {
	value: true
});

var _vue = require('vue');

var _vue2 = _interopRequireDefault(_vue);

var _vueRouter = require('vue-router');

var _vueRouter2 = _interopRequireDefault(_vueRouter);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

_vue2.default.use(_vueRouter2.default);

exports.default = new _vueRouter2.default({
	mode: 'history',
	routes: [
	//		{path: '', name: '', component: resolve => require ('../components/', resolve)},
	{ path: '/list', name: 'list', component: function component(resolve) {
			return require(['../components/list.vue'], resolve);
		} }]
});
//# sourceMappingURL=index.js.map