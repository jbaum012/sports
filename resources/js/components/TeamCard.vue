<template>
  <div class="d-flex flex-grow" :style="cardStyle">
    <div class="p-2 pb-0 text-white text-center w-100" :style="teamStyle">
      {{ team.nickname }}
    </div>
    <div
      v-if="score !== null"
      class="d-flex align-items-center p-2 bg-white h4 mb-0"
    >
      {{ score }}
    </div>
  </div>
</template>

<script>
export default {
  props: {
    team: {
      type: Object,
      required: true
    },
    highlight: {
      type: Boolean,
      default: false
    },
    score: {
      type: Number,
      default: null
    },
    variant: {
      type: String,
      default: 'right'
    }
  },
  computed: {
    cardStyle() {
      return {
        outline: this.highlight ? '10px solid hotpink' : '1px solid black',
        'flex-direction': this.variant === 'right' ? 'row' : 'row-reverse'
      }
    },
    teamStyle() {
      return {
        backgroundColor: this.team.primary_color,
        borderBottom: '5px solid ' + this.team.secondary_color
      }
    }
  }
}
</script>

<style scoped></style>
