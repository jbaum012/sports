<template>
  <tr>
    <td>
      <team-card v-if="game.user_bet" :team="game.user_bet.team" @click="doubleDown" />
      <span v-else>-</span>
    </td>
    <td>
      <div class="d-flex align-items-center justify-content-between">
        <team-card class="pointer" :team="game.away_team" @click.native="betOnTeam(game.away_team)"></team-card>
        <span>@</span>
        <team-card class="pointer" :team="game.home_team" @click.native="betOnTeam(game.home_team)"></team-card>
      </div>
    </td>
    <td>
      <span v-if="game.spread_team">{{ game.spread_team.nickname }}</span>
      <code v-if="game.spread">{{ game.spread }}</code>
    </td>
    <td>{{ homeScore }} - {{ awayScore }}</td>
    <td>
      <b-button variant="primary">Update Game</b-button>
      <b-button variant="secondary">View Bets</b-button>
    </td>
  </tr>
</template>

<script>
import axios from 'axios'
import TeamCard from './TeamCard.vue'
export default {
  components: {
    TeamCard
  },
  props: {
    game: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      selected_team: null
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
    }
  },
  methods: {
    doubleDown() {
      if (this.game.allow_bets) {
        console.log('doubledown')
      }
    },
    betOnTeam(team) {
      if (this.game.allow_bets) {
        if (this.game.user_bet === null) {
          axios
            .post('/api/bet', { game_id: this.game.id, team_id: team.id })
            .then((r) => {
              this.game.user_bet = r.data
            })
        } else {
          this.game.user_bet.team_id = team.id
          axios
            .put(`/api/bet/${this.game.user_bet.id}`, this.game.user_bet)
            .then((r) => {
              this.game.user_bet = r.data
            })
        }
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
