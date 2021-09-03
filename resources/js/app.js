/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');




window.Vue = require('vue').default;
window.Vue.config.productionTip = false

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faCheck, faTimes,faSortAlphaUp,faSortAlphaDown } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'


library.add(faCheck, faTimes,faSortAlphaUp,faSortAlphaDown)

Vue.component('font-awesome-icon', FontAwesomeIcon)
Vue.component('main-component', require('./components/MainComponent.vue').default);
Vue.component('news-list-component', require('./components/NewsListComponent.vue').default);
Vue.component('news-form-component', require('./components/NewsFormComponent.vue').default);


const app = new Vue({
    el: '#app',
});
