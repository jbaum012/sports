<template>
  <div>
    <h1 class="d-flex">
      Week {{ week }}
      <b-button class="ml-auto mr-2" varient="primary" v-b-modal.new-game-modal
        >Add Game</b-button
      >
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
        <betting-card
          v-for="game in games"
          :key="game.id"
          :game="game"
          @deleted="fetchData"
        />
      </tbody>
    </table>
    <b-modal
      id="new-game-modal"
      title="Game"
      size="lg"
      hide-footer
      :no-close-on-backdrop="true"
    >
      <game-form @saved="newGameAdded"></game-form>
    </b-modal>
  </div>
</template>

<script>
import axios from 'axios'
import { mapState, mapMutations } from 'vuex'
import BettingCard from '../components/BettingCard.vue'
import GameForm from '../components/GameForm.vue'
export default {
  components: {
    BettingCard,
    GameForm
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
    if (this.teams === null) {
      this.fetchTeams()
    }
  },
  computed: {
    ...mapState(['teams'])
  },
  methods: {
    fetchData() {
      axios.get(`/api/week/${this.week}/games`).then(r => (this.games = r.data))
    },
    fetchTeams() {
      axios.get('/api/teams').then(r => this.setTeams(r.data))
    },
    newGameAdded() {
      this.$bvModal.hide('new-game-modal')
      this.fetchData()
    },
    ...mapMutations(['setTeams'])
  },
  watch: {
    // call again the method if the route changes
    $route: 'fetchData'
  }
}
</script>

<style scoped></style>
