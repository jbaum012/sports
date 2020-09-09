<template>
  <div>
    <b-row>
      <b-col sm="12" md="6">
        <label for="game-date">Date</label>
        <b-form-datepicker
          id="date"
          v-model="game.date"
          class="mb-2"
        ></b-form-datepicker>
      </b-col>
      <b-col sm="12" md="6">
        <label for="game-date">Time</label>
        <b-form-timepicker
          minutes-step="5"
          v-model="game.time"
          locale="en"
        ></b-form-timepicker>
      </b-col>
    </b-row>
    <hr />
    <b-row v-if="teams">
      <b-col sm="12" md="6">
        <label for="home_team">Home Team</label>
        <v-select
          placeholder="Home team"
          :options="homeTeams"
          label="name"
          :clearable="false"
          :reduce="team => team.id"
          v-model="game.home_team_id"
        ></v-select>
        <label>Score</label>
        <b-input v-model="game.home_team_score"></b-input>
      </b-col>
      <b-col sm="12" md="6">
        <label for="away_team">Away Team</label>
        <v-select
          placeholder="Away team"
          :options="awayTeams"
          label="name"
          :clearable="false"
          :reduce="team => team.id"
          v-model="game.away_team_id"
        ></v-select>
        <label>Score</label>
        <b-input v-model="game.away_team_score"></b-input>
      </b-col>
    </b-row>
    <hr />
    <label>Spread</label>
    <b-row>
      <b-col sm="12" md="6">
        <b-input v-model="game.spread"></b-input>
      </b-col>
      <b-col sm="12" md="6">
        <v-select
          v-if="game.home_team_id && game.away_team_id"
          placeholder="Spread Team"
          :options="spreadTeams"
          label="name"
          :reduce="team => team.id"
          v-model="game.spread_team_id"
        ></v-select>
      </b-col>
    </b-row>
    <hr />
    <div class="d-flex">
      <confirm-delete
        v-if="game.id"
        class="mr-auto"
        warning="This wil delete all bets for this game. Are you sure?"
        @confirmed="deleteGame"
      />
      <b-button
        @click="saveGame"
        class="ml-auto"
        variant="primary"
        :disabled="invalidGame"
        >Save</b-button
      >
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import { mapState } from 'vuex'
import ConfirmDelete from './ConfirmDelete.vue'

export default {
  components: {
    ConfirmDelete
  },
  props: {
    gameId: {
      type: Number,
      required: false
    }
  },
  data() {
    return {
      game: {
        id: null,
        season_id: 1,
        date: null,
        time: null,
        home_team_score: null,
        away_team_score: null,
        home_team_id: null,
        away_team_id: null,
        spread: null,
        spread_team_id: null
      }
    }
  },
  beforeMount() {
    if (this.gameId) {
      axios.get(`/api/game/${this.gameId}`).then(r => {
        this.game = r.data
      })
    }
  },
  computed: {
    homeTeams() {
      return this.teams.filter(team => team.id !== this.game.away_team_id)
    },
    awayTeams() {
      return this.teams.filter(team => team.id !== this.game.home_team_id)
    },
    spreadTeams() {
      return [this.game.home_team, this.game.away_team]
    },
    invalidGame() {
      return (
        this.game.date === null ||
        this.game.time === null ||
        this.game.home_team_id === null ||
        this.game.away_team_id === null ||
        (this.game.spread !== null && this.game.spread_team_id === null) ||
        (this.game.spread === null && this.game.spread_team_id !== null)
      )
    },
    ...mapState(['teams'])
  },
  methods: {
    saveGame() {
      if (this.game.id) {
        axios
          .put(`/api/game/${this.game.id}`, this.game)
          .then(r => this.$emit('saved', r.data))
      } else {
        axios
          .post('/api/game', this.game)
          .then(r => this.$emit('saved', r.data))
      }
    },
    deleteGame() {
      axios
        .delete(`/api/game/${this.game.id}`)
        .then(r => this.$emit('deleted', r.data))
    }
  },
  watch: {
    'game.home_team_id'(newValue, oldValue) {
      if (newValue) {
        this.game.home_team = this.teams.find(team => team.id === newValue)
        if (oldValue !== null && this.game.spread_team_id === oldValue) {
          this.game.spread_team_id = newValue
        }
      }
    },
    'game.away_team_id'(newValue, oldValue) {
      if (newValue) {
        this.game.away_team = this.teams.find(team => team.id === newValue)
        if (oldValue !== null && this.game.spread_team_id === oldValue) {
          this.game.spread_team_id = newValue
        }
      }
    }
  }
}
</script>

<style scoped></style>
