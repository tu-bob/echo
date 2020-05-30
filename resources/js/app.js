/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import {store} from './store';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import VueObserveVisibility from 'vue-observe-visibility'
import VueSocialSharing from 'vue-social-sharing'

require('./bootstrap');
require('./yandex-audio');

// let App = require('./app/App.vue').default;
let router = require('./app/Routes.vue').default;

let BootstrapVue = require('bootstrap-vue').default;
let VueRouter = require('vue-router').default;
let VueLuxon = require('vue-luxon');
import {DateTime} from 'luxon';

window.Vue = require('vue');
window.Vue.use(BootstrapVue);
window.Vue.use(VueRouter);
window.Vue.use(VueObserveVisibility);
Vue.use(VueSocialSharing);
window.Vue.use(VueLuxon
    ,{
    serverZone: 'utc',
    // serverFormat: 'sql',
    clientZone: DateTime.local().zoneName,
    clientFormat: 'locale',
    localeLang: null,
    localeFormat: {},
    diffForHumans: {},
    i18n: {}
}
);

// window.Vue.prototype.$eventHub = new Vue();

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('App', require('./app/App.vue').default);
Vue.component('SuggestionInput', require('./components/common/inputs/SuggestionInput.vue').default);
Vue.component('font-awesome-icon', FontAwesomeIcon)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

window.app = new Vue({
    el: '#app',
    router,
    store
    // render: h => h(App)
});
