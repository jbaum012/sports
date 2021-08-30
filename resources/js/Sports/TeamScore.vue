<template>
  <div
    :style="style"
    class="flex justify-evenly items-center flex-none h-11 w-10 text-2xl p-5 font-bold"
  >
    {{ scoreDisplay }}
  </div>
</template>
<script>
import { defineComponent } from 'vue'
export default defineComponent({
  props: {
    score: Number,
    team: Object,
    results: Object
  },
  computed: {
    style() {
      let color = "black";
      if (this.won) {
        color = 'limegreen'
      }
      if (this.split) {
        color = 'orange'
      }
      return {
        color: color
      }
    },
    won() {
      return this.team.id === this.results?.winner?.id
    },
    split() {
      return this.results?.split
    },
    scoreDisplay() {
      return this.score === 0
        ? this.score
        : this.score || '-';
    }
  }
})
</script>
<style scoped>
  .outline {
    outline: 3px solid limegreen;
  }
</style>
