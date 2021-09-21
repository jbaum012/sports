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
    <div>
      <!-- {{ pointsDisplay(bet.points) }} -->
      <Link
        class="ml-auto col-span-2"
        :href="route('game.bets.index', {game: bet.game.id})"
      >
        <jet-button class="mx-auto text-sm">
          Bets
        </jet-button>
      </Link>
    </div>
  </div>
</template>
<script>
import TeamName from '@/Sports/TeamName.vue';
import JetButton from '@/Jetstream/Button.vue'
import { Link } from '@inertiajs/inertia-vue3'

export default {
  components: {
    TeamName,
    JetButton,
    Link,
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
