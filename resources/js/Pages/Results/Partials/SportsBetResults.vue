<template>
  <div>
    <div v-if="bet.game?.results?.split">
      Split!
    </div>
    <div v-else>
      Your pick
      <team-name
        v-if="bet.team?.abbreviation"
        class="mb-2"
        :title="bet.team?.abbreviation"
        :team="bet.team"
      />
      <span v-else>
        [unpicked]
      </span>
      {{ bet.won ? 'won' : 'lost' }}
    </div>
    <div>{{ pointsDisplay(bet.points) }}</div>
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
  emits: ['doubled'],
  setup() {
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
