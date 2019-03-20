import Axios from 'axios'
import Vue from 'vue'
import VueAxios from 'vue-axios'
import App from './components/App'
import config from './config'
import router from './router'
import store from './store'

Vue.use(VueAxios, Axios)
Axios.defaults.baseURL = config.API_BASE_URL

require('./auth')
require('./mixins')

window.app = new Vue({
    components: {App},
    el: '#app',
    router,
    store
})
