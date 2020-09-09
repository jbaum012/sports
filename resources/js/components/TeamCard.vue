<template>
  <div class="p-2 pb-0 text-white text-center" :style="style">
    {{ team.nickname }}
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
    }
  },
  computed: {
    style() {
      return {
        outline: this.highlight ? '10px solid purple' : '1px solid black',
        backgroundColor: this.team.primary_color,
        borderBottom: '5px solid ' + this.team.secondary_color
      }
    }
  }
}
</script>

<style scoped></style>
