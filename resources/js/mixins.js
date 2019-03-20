import store from './store'
import Vue from 'vue'

Vue.mixin({
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
    }
  }
})
