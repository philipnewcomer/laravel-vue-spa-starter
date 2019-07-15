import config from './config'
import store from './store'
import Vue from 'vue'

Vue.mixin({
  computed: {
    appName() {
      return config.APP_NAME
    },

    loaded() {
      return !store.state.loading
    },

    loading() {
      return store.state.loading;
    }
  },

  methods: {
    setLoading() {
      store.dispatch('setLoading')
    },

    clearLoading() {
      store.dispatch('clearLoading')
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

    clearStatus() {
      store.dispatch('clearStatus')
    },

    handleError(error) {
      const errorMessage = error.response.data.data.message
        ? error.response.data.data.message
        : error.response.data.data

      this.setStatus(errorMessage, 'error')
    }
  }
})
