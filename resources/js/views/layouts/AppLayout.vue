<template>
  <div>
    <b-navbar toggleable="lg" type="dark" class="bg-primary">
      <b-navbar-brand href="/home" class="mb-0">Sports</b-navbar-brand>

      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>
      <b-collapse id="nav-collapse" is-nav>
        <b-navbar-nav>
          <b-nav-item :to="{ name: 'week', params: { week: currentWeek } }"
            >This Week's Picks</b-nav-item
          >
          <b-nav-item :to="{ name: 'points' }">Points</b-nav-item>
          <b-nav-item :to="{ name: 'standings' }">Standings</b-nav-item>
        </b-navbar-nav>
        <b-navbar-nav>
          <v-select
            placeholder="picks by week"
            class="week-select"
            :options="weeksArray"
            @input="goToWeek"
          ></v-select>
        </b-navbar-nav>
      </b-collapse>
    </b-navbar>
    <b-container fluid class="p-0">
      <b-row :no-gutters="true">
        <b-col class="mt-3 ml-sm-3" v-if="currentWeek !== null">
          <router-view></router-view>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>
import axios from 'axios'
import { mapMutations, mapState } from 'vuex'
export default {
  beforeCreate() {
    axios.get('/api/current-week').then(r => this.setCurrentWeek(r.data))
  },
  methods: {
    goToWeek(week) {
      this.$router.push({ name: 'week', params: { week } })
    },
    ...mapMutations(['setCurrentWeek'])
  },
  computed: {
    weeksArray() {
      return Array.from({ length: this.currentWeek + 1 }, (_, i) => i + 1)
    },
    ...mapState(['currentWeek', 'totalWeeks'])
  }
}
</script>

<style>
.week-select .vs__search::placeholder,
.week-select .vs__dropdown-toggle,
.week-select .vs__dropdown-menu {
  min-width: 200px;
  background: white;
  border: none;
}
</style>
