import Vue from 'vue'
import router from './router'

Vue.router = router

Vue.use(require('@websanova/vue-auth'), {
  auth: {
    request: function (req, token) {
      this.options.http._setHeaders.call(this, req, {Authorization: 'Bearer ' + token});
    },

    response: function (res) {
      return res.data.data ? res.data.data.token : undefined
    }
  },
  http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
  router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
  tokenDefaultName: 'auth_token',
})
