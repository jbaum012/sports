<template>
  <b-container fluid>
    <h1>Picks</h1>
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
      betsByWeek: [],
      betsForWeek: [],
      busy: true
    }
  },
  components: {
    WeeklyPicks
  },
  mounted() {
    this.fetchBets()
  },
  computed: {
    ...mapState(['currentWeek'])
  },
  methods: {
    fetchBets() {
      axios.get('/api/week/9/games').then(r => {
        this.betsForWeek = r.data
        console.log(typeof this.betsForWeek)
        this.busy = false
      })
    }
  }
}
</script>

<style scoped></style>
