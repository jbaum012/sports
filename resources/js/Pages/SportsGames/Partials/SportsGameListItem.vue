<template>
  <div class="flex-grow">
    <div
      :id="'home-team-' + game.home_team_id"
      class="flex mb-1"
    >
      <team-score
        :results="game.results"
        :team="game.home_team"
        :number="homeTeamNumber"
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
        :results="game.results"
        :team="game.away_team"
        :number="awayTeamNumber"
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
import TeamName from '@/Sports/TeamName.vue'
import TeamScore from '@/Sports/TeamScore.vue'
import { computed } from 'vue'

export default {
  components: {
    TeamName,
    TeamScore,
  },
  props: {
    game: Object,
  },
  setup(props) {
    const homeTeamNumber = computed(()=> {
      return props.game.home_team_score !== null
        ? props.game.home_team_score
        : props.game.home_team_spread
    });
    const awayTeamNumber = computed(()=>{
      return props.game.away_team_score !== null
        ? props.game.away_team_score
        : props.game.away_team_spread
    });
    return {
      homeTeamNumber,
      awayTeamNumber
    }
  }
}
</script>
