import store from './store'
import Vue from 'vue'

Vue.mixin({
  computed: {
    isUserEmailVerified() {
      return !!this.$auth.user().email_verified_at
    }
  },

  methods: {
    clearStatus() {
      store.dispatch('clearStatus')
    },

    setStatus(message, type) {
      const status = {
        message,
        type
      }

      if (!status.type) {
        status.type = 'success'
      }

      store.dispatch('setStatus', {status})
    },

    parseErrors(error) {
      if ('error' === error.response.data.status) {
        return {message: error.response.data.message}
      }

      return error.response.data.data
    }
  }
})
