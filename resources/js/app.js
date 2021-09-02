/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;


Vue.component('main-component', require('./components/MainComponent.vue').default);
Vue.component('news-list-component', require('./components/NewsListComponent.vue').default);
Vue.component('news-form-component', require('./components/NewsFormComponent.vue').default);

const app = new Vue({
    el: '#app',
});
