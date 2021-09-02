<template>
  <div
    :style="style"
    class="flex justify-evenly items-center flex-none h-11 w-10 text-lg p-5 font-bold"
  >
    {{ scoreDisplay }}
  </div>
</template>
<script>
import { defineComponent } from 'vue'
export default defineComponent({
  props: {
    number: Number,
    team: Object,
    results: Object,
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
      return this.team.id === this.results?.spread_winner?.id
    },
    split() {
      return this.results?.split
    },
    scoreDisplay() {
      return this.number === null
        ? '-'
        : this.number;
    }
  }
})
</script>
