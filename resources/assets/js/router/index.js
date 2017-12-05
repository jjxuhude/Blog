import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use (VueRouter);

export default new VueRouter ({
	mode: 'history',
	routes: [
//		{path: '', name: '', component: resolve => require ('../components/', resolve)},
		{path: '/list', name: 'list', component: resolve => require (['../components/list.vue'], resolve)},
	]
});