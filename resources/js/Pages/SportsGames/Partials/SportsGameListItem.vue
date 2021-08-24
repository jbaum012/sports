<template>
  <Link :href="route('games.show', {game: game.id})">
    <div class="flex w-full border-b-2 border-gray-100 p-2">
      <div class="w-1/5">
        <div
          v-if="game.winner"
          class="h-full"
        >
          <div class="h-1/2 flex">
            <span
              v-if="game.home_team.id === game.winner.id"
              class="m-auto"
            >
              Winner -->
            </span>
            <span v-else>
              &nbsp;
            </span>
          </div>
          <div class="h-1/2 flex">
            <span
              v-if="game.away_team.id === game.winner.id"
              class="m-auto"
            >
              Winner -->
            </span>
            <span v-else>
              &nbsp;
            </span>
          </div>
        </div>
      </div>
      <div class="w-2/5 my-auto">
        <team-name :team="game.home_team" />
        <team-name :team="game.away_team" />
      </div>
      <div class="flex m-auto h-full p-2 w-2/5">
        {{ gameTime }}
      </div>
    </div>
  </Link>
</template>
<script>
import { defineComponent } from 'vue'
import TeamName from '@/Sports/TeamName.vue'
import { DateTime } from 'luxon'
import { Link } from '@inertiajs/inertia-vue3'
import { localize } from '@/helpers.js'

export default defineComponent({
  components: {
    TeamName,
    Link
  },
  props: {
    game: Object
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
