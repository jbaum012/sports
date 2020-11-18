<template>
  <b-container fluid>
    <h1>Picks</h1>
    <div class="d-flex justify-content-between mb-2">
      <button class="btn btn-primary" @click="week--">prev week</button>
      Week {{week}}
      <button class="btn btn-primary" @click="week++" v-if="week != currentWeek">next week</button>
    </div>
    <div v-if="!busy">
      <weekly-picks
        :picks="betsForWeek"
        :open="true"
        :week="currentWeek"
      >
      </weekly-picks>
    </div>
    <div v-else>
      <b-card v-for="(n, index) in 5" :key="index" class="mb-2">
        <skeleton-loader
          height="40px"
          width="100%"
          :random-width="false"
        ></skeleton-loader>
      </b-card>
    </div>
  </b-container>
</template>

<script>
import axios from 'axios'
import { mapState } from 'vuex'
import WeeklyPicks from '../components/WeeklyPicks.vue'
export default {
  data() {
    return {
      week: null,
      betsForWeek: [],
      busy: true
    }
  },
  components: {
    WeeklyPicks
  },
  mounted () {
    this.week = this.currentWeek
    this.fetchBets()
  },
  computed: {
    ...mapState(['currentWeek'])
  },
  methods: {
    fetchBets() {
      axios.get('/api/week/'+ this.week + '/games').then(r => {
        this.betsForWeek = r.data
        this.busy = false
      })
    }
  },
  watch: {
    week(newValue, oldValue) {
      this.fetchBets()
    }
  },
}
</script>

<style scoped></style>
