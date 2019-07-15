import Vue from 'vue'
import Vuex from 'vuex'
import types from './mutation-types'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    loading: true,
    status: null
  },

  mutations: {
    [types.SET_LOADING] (state) {
      state.loading = true
    },

    [types.CLEAR_LOADING] (state) {
      state.loading = false
    },

    [types.SET_STATUS] (state, payload) {
      state.status = payload.status
    },

    [types.CLEAR_STATUS] (state) {
      state.status = null
    }
  },

  actions: {
    setLoading(context) {
      context.commit(types.SET_LOADING)
    },

    clearLoading(context) {
      context.commit(types.CLEAR_LOADING)
    },

    setStatus(context, payload) {
      context.commit(types.SET_STATUS, payload)
    },

    clearStatus(context) {
      context.commit(types.CLEAR_STATUS)
    }
  }
})
