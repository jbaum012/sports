<template>
  <div class="flex w-full border-b-2 border-gray-100 p-2">
    <div class="w-1/2 my-auto">
      <team-name :team="game.home_team" />
      <team-name :team="game.away_team" />
    </div>
    <div class="flex m-auto h-full p-2 w-1/2">
      {{ gameTime }}
    </div>
  </div>
</template>
<script>
import { defineComponent } from 'vue'
import TeamName from '@/Sports/TeamName.vue'
import { DateTime } from 'luxon'
export default defineComponent({
  components: {
    TeamName
  },
  props: {
    game: Object
  },
  setup(props) {
    const gameTime = DateTime
      .fromISO(props.game.starts_at)
      .toLocaleString(DateTime.DATETIME_MED)
    return {
      gameTime
    }
  }
})
</script>
