import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
  state: {
    user: null,
    teams: null
  },
  mutations: {
    setUser(state, user) {
      state.user = user
    },
    setTeams(state, teams) {
      state.teams = teams
    }
  }
})

export default store
