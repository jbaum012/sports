<template>
  <div>
    <h1>Hello World</h1>
    <b-container>
      <b-row cols="2">
        <b-col v-for="team in teams" :key="team.id">
          <team-card :team="team" />
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>
import axios from 'axios'
import TeamCard from '../components/TeamCard.vue'
export default {
  components: {
    TeamCard
  },
  data() {
    return {
      teams: []
    }
  },
  mounted() {
    axios.get('/api/teams').then(r => (this.teams = r.data))
  }
}
</script>

<style scoped></style>
