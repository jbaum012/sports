<template>
  <b-container fluid>
    <h1>Everyone's picks</h1>
    <!-- TODO: completely rethink this component -->
    <b-row cols="1">
      <b-col v-for="(week, index) in betsByWeek" :key="index">
        <b-card no-body class="mb-1">
          <weekly-picks
            :picks="week"
            :variant="index == currentWeek ? 'primary' : 'secondary'"
            :open="index == currentWeek"
            :week="index + 1"
          >
          </weekly-picks>
        </b-card>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import axios from 'axios'
import { mapState } from 'vuex'
import WeeklyPicks from '../components/WeeklyPicks.vue'
export default {
  components: {
    WeeklyPicks
  },
  mounted() {
    axios.get('/api/games').then(r => {
      this.betsByWeek = r.data
    })
  },
  data() {
    return {
      betsByWeek: []
    }
  },
  computed: {
    ...mapState(['currentWeek'])
  }
}
</script>

<style scoped></style>
