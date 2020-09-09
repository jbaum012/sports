<template>
  <div>
    <h1 class="d-flex">
      Week {{ week }}
      <b-button class="ml-auto mr-2" varient="primary">Add Game</b-button>
    </h1>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">My Bet</th>
          <th scope="col">Teams</th>
          <th scope="col">Spread</th>
          <th scope="col">Score</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <betting-card v-for="game in games" :key="game.id" :game="game" />
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from 'axios'
import BettingCard from '../components/BettingCard.vue'
export default {
  components: {
    BettingCard
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
      axios
        .get(`/api/week/${this.week}/games`)
        .then((r) => (this.games = r.data))
    },
    submitBet(team) {
      console.log(team.name)
    }
  },
  watch: {
    // call again the method if the route changes
    $route: 'fetchData'
  }
}
</script>

<style scoped></style>
