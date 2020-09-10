import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
  state: {
    user: null,
    teams: null,
    currentWeek: null,
    totalWeeks: 17
  },
  mutations: {
    setUser(state, user) {
      state.user = user
    },
    setTeams(state, teams) {
      state.teams = teams
    },
    setCurrentWeek(state, week) {
      state.currentWeek = week
    }
  }
})

export default store
