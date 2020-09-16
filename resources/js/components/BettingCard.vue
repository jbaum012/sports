<template>
  <tr :class="resultsClass">
    <td class="d-flex justify-content-center">
      <team-card
        style="flex-basis: 100%"
        :class="{ pointer: game.allow_bets }"
        :dim="busy"
        v-if="game.user_bet"
        :highlight="game.user_bet.double_down"
        :team="game.user_bet.team"
        @click.native="doubleDown"
      />
      <span v-else>-</span>
    </td>
    <td>
      <div class="d-flex align-items-center justify-content-around">
        <team-card
          style="flex-basis: 33%;"
          :class="{ pointer: game.allow_bets }"
          :dim="busy"
          :team="game.away_team"
          :score="game.away_team_score"
          @click.native="betOnTeam(game.away_team)"
        ></team-card>
        <div
          class="p-1 h4 d-flex justify-content-center"
          style="flex-basis: 33%"
        >
          <span v-if="game.winner">to</span>
          <span v-else>@</span>
        </div>
        <team-card
          style="flex-basis: 33%;"
          :class="{ pointer: game.allow_bets }"
          :dim="busy"
          :team="game.home_team"
          :score="game.home_team_score"
          @click.native="betOnTeam(game.home_team)"
          variant="left"
        ></team-card>
      </div>
    </td>
    <td>
      <span v-if="game.spread_team">{{ game.spread_team.nickname }}</span>
      <code v-if="game.spread">{{ game.spread }}</code>
    </td>
    <!-- <td>{{ awayScore }} - {{ homeScore }}</td> -->
    <td>
      <b-button variant="primary" v-b-modal="gameModalId">Update Game</b-button>
      <b-modal
        :id="gameModalId"
        title="Game"
        size="lg"
        hide-footer
        :no-close-on-backdrop="true"
      >
        <game-form
          :game-id="game.id"
          @saved="$bvModal.hide(gameModalId)"
          @deleted="$emit('deleted')"
        ></game-form>
      </b-modal>
    </td>
  </tr>
</template>

<script>
import axios from 'axios'
import TeamCard from './TeamCard.vue'
import GameForm from './GameForm.vue'
export default {
  components: {
    TeamCard,
    GameForm
  },
  props: {
    game: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      selected_team: null,
      busy: false
    }
  },
  computed: {
    spread() {
      if (!this.game.spread_team) {
        return ''
      }
      return this.game.spread_team.nickname + ' - ' + this.game.spread
    },
    homeScore() {
      return this.game.home_team_score ?? 0
    },
    awayScore() {
      return this.game.away_team_score ?? 0
    },
    gameModalId() {
      return 'game-modal-' + this.game.id
    },
    resultsClass() {
      let hasWinner = this.game.winner !== null
      let wonBet = this.game.user_bet !== null && this.game.user_bet.won
      return {
        'table-success': wonBet,
        'table-danger': hasWinner && !wonBet
      }
    }
  },
  methods: {
    doubleDown() {
      if (this.busy || !this.game.allow_bets) {
        return
      }
      this.busy = true
      if (this.game.user_bet.double_down) {
        axios
          .delete(`/api/bet/${this.game.user_bet.id}/double-down`)
          .then(r => (this.game.user_bet = r.data))
          .finally(() => (this.busy = false))
      } else {
        axios
          .post(`/api/bet/${this.game.user_bet.id}/double-down`)
          .then(r => (this.game.user_bet = r.data))
          .finally(() => (this.busy = false))
      }
    },
    betOnTeam(team) {
      if (
        this.busy ||
        !this.game.allow_bets ||
        this.game.user_bet.team.id === team.id
      ) {
        return
      }
      this.busy = true
      if (this.game.user_bet === null) {
        axios
          .post('/api/bet', { game_id: this.game.id, team_id: team.id })
          .then(r => (this.game.user_bet = r.data))
          .finally(() => (this.busy = false))
      } else {
        this.game.user_bet.team_id = team.id
        axios
          .put(`/api/bet/${this.game.user_bet.id}`, this.game.user_bet)
          .then(r => (this.game.user_bet = r.data))
          .finally(() => (this.busy = false))
      }
    }
  }
}
</script>

<style lang="scss" scoped>
.pointer:hover {
  cursor: pointer;
}
</style>
