<template>
  <div>
    <h1 class="d-flex">
      Week {{ week }}
      <b-button class="ml-auto mr-2" varient="primary">Add Game</b-button>
    </h1>
    <b-container>
      <b-row cols="2">
        <b-col v-for="game in games" :key="game.id">
          <b-card>
            <b-row>
              <b-col>
                <team-card :team="game.away_team"></team-card>
              </b-col>
              <b-col>
                <team-card :team="game.home_team"></team-card>
              </b-col>
            </b-row>
          </b-card>
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
  props: {
    week: {
      type: Number,
      required: true
    }
  },
  data() {
    return {
      games: []
    }
  },
  mounted() {
    this.fetchData()
  },
  methods: {
    fetchData() {
      axios.get(`/api/week/${this.week}/games`).then(r => (this.games = r.data))
    }
  },
  watch: {
    // call again the method if the route changes
    $route: 'fetchData'
  }
}
</script>

<style scoped></style>
