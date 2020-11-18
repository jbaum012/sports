<template>
  <div class="container-fliud">
    <div class="row">
      <game-bet
        v-for="game in picks"
        :key="game.id"
        :game="game"
      ></game-bet>
    </div>
  </div>
</template>

<script>
import GameBet from './GameBet.vue'
export default {
  components: {
    GameBet
  },
  props: {
    picks: {
      type: Array,
      required: true
    },
    variant: {
      type: String,
      default: 'secondary'
    },
    open: {
      type: Boolean,
      default: false
    },
    week: {
      required: true
    }
  }
}
</script>

<style scoped></style>
