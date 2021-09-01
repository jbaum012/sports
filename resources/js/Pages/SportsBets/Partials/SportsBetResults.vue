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
      v-if="!bet.doubled"
      class="block m-auto bg-gray-300 hover:bg-gray-500 text-white font-bold py-1 px-2 rounded-lg"
      @click="doubleDown"
    >
      double
    </button>
    <button
      v-else
      class="block m-auto bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded-lg"
      @click="undoubleDown"
    >
      doubled
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
  emits: ['doubled'],
  setup(props, { emit }) {
    const doubleDown = async (event) => {
      try {
        await axios.post(route('double-down', {
          bet: props.bet.id,
        }));
        emit('doubled', true);
      } catch(e) {
        event.target.classList.add('animate-shake');
        setTimeout(()=> {
          event.target.classList.remove('animate-shake')
        }, 1000)
      }
    };
    const undoubleDown = async () => {
      try{
        await axios.delete(route('double-down.destroy', {
          bet: props.bet.id
        }));
        emit('doubled', false);
      } catch (e) {
      }
    };
    const pointsDisplay = (points) => {
      return points >= 0
        ? '+' + points
        : points
    }
    return {
      pointsDisplay,
      doubleDown,
      undoubleDown,
    }
  }
}
</script>
