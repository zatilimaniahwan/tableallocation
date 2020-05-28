/*
---------------------------------------------------------
| *** Developed by Nurzatilimani binti Muhamad Ahwan     |
| *** Last Update: 17/12/2019                            |
---------------------------------------------------------
*/

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueDataTables from 'vue-data-tables';
import axios from 'axios';
import VueAxios from 'vue-axios';
import ElementUI from 'element-ui';
import lang from 'element-ui/lib/locale/lang/en';
import locale from 'element-ui/lib/locale';
import Vuelidate from 'vuelidate';
import VueSwal from 'vue-swal';
import pjaxAdapter from 'vue-pjax-adapter';
import VueApexCharts from 'vue-apexcharts';


locale.use(lang);
Vue.use(ElementUI);
Vue.use(VueDataTables);
Vue.use(VueAxios, axios);
Vue.use(Vuelidate);
Vue.use(VueSwal);
Vue.use(pjaxAdapter,{targetSelector:'#pjax-content'});
Vue.use(VueApexCharts);
Vue.component('apexchart', VueApexCharts);

Vue.config.productionTip = false;
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Testing Layout
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

// Master Layout
Vue.component('sidebar-component', require('./components/master/SidebarComponent.vue').default);
Vue.component('dashboard-component', require('./components/master/DashboardComponent.vue').default);

// Module
Vue.component('statustable-component',require('./components/data/StatusTableComponent.vue').default);
Vue.component('table-component',require('./components/data/TableComponent.vue').default);
Vue.component('audittrail-component',require('./components/Audittrail.vue').default);
Vue.component('checkavail-component',require('./components/data/CheckAvailable.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

window.baseUrl="/tableallocation/laravel/public";

const app = new Vue({
    el: '#app'

});
