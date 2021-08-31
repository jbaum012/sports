<template>
  <div v-if="bet.locked">
    <div v-if="bet.game?.results?.split">
      Split!
    </div>
    <div v-else>
      Your pick
      <team-name
        v-if="bet.team?.abbreviation"
        class="mb-2"
        :title="bet.game.home_team.abbreviation"
        :team="bet.game.home_team"
      />
      <span v-else>
        [unpicked]
      </span>
      {{ bet.won ? 'won' : 'lost' }}
    </div>
    <div>{{ pointsDisplay(bet.points) }}</div>
  </div>
  <div
    v-else-if="!!bet.team"
  >
    Pick:
    <team-name
      class="mb-2"
      :title="bet.team.abbreviation"
      :team="bet.team"
    />
    <button
      class="block m-auto bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded-lg"
    >
      double
    </button>
  </div>
</template>
<script>
import TeamName from '@/Sports/TeamName.vue';

export default {
  components: {
    TeamName,
  },
  props: {
    bet: Object
  },
  setup(props) {
    const pointsDisplay = (points) => {
      return points >= 0
        ? '+' + points
        : points
    }
    return {
      pointsDisplay,
    }
  }
}
</script>
