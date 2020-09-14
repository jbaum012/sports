<template>
  <b-tr>
    <b-td :class="homeTeamResults">
      <user-card
        v-for="bet in game.home_bets"
        :key="bet.id"
        :user="bet.user"
        :highlight="bet.double_down"
        :show-name="false"
      >
      </user-card>
    </b-td>
    <b-td :class="homeTeamResults">
      <team-card :team="game.home_team"></team-card>
    </b-td>
    <b-td :class="awayTeamResults">
      <team-card :team="game.away_team"></team-card>
    </b-td>
    <b-td :class="awayTeamResults">
      <user-card
        v-for="bet in game.away_bets"
        :key="bet.id"
        :user="{ name: bet.user, avatar: bet.user_avatar }"
        :highlight="bet.double_down"
        variant="icon"
      >
      </user-card>
    </b-td>
  </b-tr>
</template>

<script>
import TeamCard from './TeamCard.vue'
import UserCard from './UserCard.vue'
export default {
  components: {
    TeamCard,
    UserCard
  },
  props: {
    game: {
      type: Object,
      required: true
    }
  },
  computed: {
    homeTeamResults() {
      return {
        'table-warning': this.game.winner === null && this.game.has_scores,
        'table-success':
          this.game.winner !== null &&
          this.game.winner.id === this.game.home_team.id
      }
    },
    awayTeamResults() {
      return {
        'table-warning': this.game.winner === null && this.game.has_scores,
        'table-success':
          this.game.winner !== null &&
          this.game.winner.id === this.game.away_team.id
      }
    }
  }
}
</script>

<style scoped></style>
