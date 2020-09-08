<template>
  <b-card
    class="mb-2"
    :style="{
      backgroundColor: team.primary_color,
      borderBottom: '10px solid ' + team.secondary_color
    }"
  >
    <h2 class="text-white m-0">{{ team.name }}</h2>
  </b-card>
</template>

<script>
export default {
  props: {
    team: {
      type: Object,
      required: true
    }
  }
}
</script>

<style scoped></style>
