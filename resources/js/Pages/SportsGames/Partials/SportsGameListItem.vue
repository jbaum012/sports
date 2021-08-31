<template>
  <div class="flex-grow">
    <div
      :id="'home-team-' + game.home_team_id"
      class="flex mb-1"
    >
      <team-score
        v-if="showScores"
        :results="game.results"
        :team="game.home_team"
        :score="game.home_team_score"
      />
      <team-name
        class="flex-grow"
        :team="game.home_team"
      />
    </div>
    <div
      :id="'away-team-' + game.away_team_id"
      class="flex"
    >
      <team-score
        v-if="showScores"
        :results="game.results"
        :team="game.away_team"
        :score="game.away_team_score"
      />
      <team-name
        class="flex-grow"
        :highlight="game.results?.winner?.id === game.away_team.id"
        :team="game.away_team"
      />
    </div>
  </div>
</template>
<script>
import { defineComponent } from 'vue'
import TeamName from '@/Sports/TeamName.vue'
import TeamScore from '@/Sports/TeamScore.vue'
import { DateTime } from 'luxon'
import { localize } from '@/helpers.js'

export default defineComponent({
  components: {
    TeamName,
    TeamScore,
  },
  props: {
    game: Object,
    showScores: {
      type: Boolean,
      default: true
    },
  },
  setup(props) {
    const gameTime = localize(props.game.starts_at)
      .toLocaleString(DateTime.DATETIME_MED)
    return {
      gameTime
    }
  }
})
</script>
