/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');




window.Vue = require('vue').default;
window.Vue.config.productionTip = false

import VueToasted from 'vue-toasted';
import { library } from '@fortawesome/fontawesome-svg-core'
import { faCheck, faTimes,faSortAlphaUp,faSortAlphaDown,faTrash,faFilter,faSearch } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

import vSelect from 'vue-select'


library.add(faCheck, faTimes,faSortAlphaUp,faSortAlphaDown,faTrash,faFilter,faSearch)

Vue.component('font-awesome-icon', FontAwesomeIcon)
Vue.component('v-select', vSelect)
Vue.use(VueToasted)

Vue.component('main-component', require('./components/MainComponent.vue').default);
Vue.component('news-list-component', require('./components/NewsListComponent.vue').default);
Vue.component('news-form-component', require('./components/NewsFormComponent.vue').default);
Vue.component('sort-icon-component', require('./components/SortIconComponent.vue').default);
Vue.component('news-filter-component', require('./components/NewsFilterComponent').default);
Vue.component('news-table-component', require('./components/NewsTableComponent.vue').default);
Vue.component('news-search-input-component', require('./components/NewsSearchInputComponent.vue').default);


const app = new Vue({
    el: '#app',
});
