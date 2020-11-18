<template>
  <div class="col-lg-4 col-md-6 col-12">
    <div class="rounded mb-4 shadowed" style="border: 2px solid #00408e;">
      <div class="game-vs-box"></div>
      <div class='d-flex p-2 justify-content-around' style="min-height: 66px;" :class="homeTeamResults">
        <user-card
          v-if="game.home_bets.length > 0"
          v-for="bet in game.home_bets"
          :key="bet.id"
          :user="{ name: bet.user, avatar: bet.user_avatar }"
          :highlight="bet.double_down"
          variant="icon"
        ></user-card>
      </div>
      <div>
        <team-card :team="game.home_team"></team-card>
      </div>
      <div>
        <team-card :team="game.away_team"></team-card>
      </div>
      <div class="d-flex p-2 justify-content-around" style="min-height: 66px;" :class="awayTeamResults">
        <user-card
          v-if="game.away_bets.length > 0"
          v-for="bet in game.away_bets"
          :key="bet.id"
          :user="{ name: bet.user, avatar: bet.user_avatar }"
          :highlight="bet.double_down"
          variant="icon"
        ></user-card>
        <div v-else style="height:40px;">No one</div>
      </div>
    </div>
  </div>
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
        'game-lost': this.game.winner !== null &&
          this.game.winner.id !== this.game.home_team.id,
        'game-split': this.game.winner === null && this.game.has_scores,
        'game-won':
          this.game.winner !== null &&
          this.game.winner.id === this.game.home_team.id
      }
    },
    awayTeamResults() {
      return {
        'game-lost': this.game.winner !== null &&
          this.game.winner.id !== this.game.away_team.id,
        'game-split': this.game.winner === null && this.game.has_scores,
        'game-won':
          this.game.winner !== null &&
          this.game.winner.id === this.game.away_team.id
      }
    }
  }
}
</script>

<style lang="scss" scoped>
.shadowed {
    box-shadow: 0px 3px 15px rgba(0,0,0,0.2);
}
.game-won {
  background-color: rgba(green, 0.3);
}
.game-lost {
  background-color: rgba(red, 0.3);
}
.game-split {
  background-color: rgba(gray, 0.3);
}
</style>
