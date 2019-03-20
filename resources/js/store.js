import Vue from 'vue'
import Vuex from 'vuex'
import types from './mutation-types'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    status: null,
  },

  mutations: {
    [types.SET_STATUS] (state, payload) {
      state.status = payload.status
    },

    [types.CLEAR_STATUS] (state) {
      state.status = null
    }
  },

  actions: {
    setStatus(context, payload) {
      context.commit(types.SET_STATUS, payload)
    },

    clearStatus(context) {
      context.commit(types.CLEAR_STATUS)
    }
  }
})
