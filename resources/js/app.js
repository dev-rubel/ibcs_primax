import Vue from 'vue'
import Welcome from './App.vue'
import router from './router'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap'

import FlashMessage from '@smartweb/vue-flash-message'
import BootstrapVue from 'bootstrap-vue'
Vue.use(BootstrapVue)
Vue.use(FlashMessage)

const app = new Vue({
    el: '#app',
    router,
    render: h => h(Welcome)
});
