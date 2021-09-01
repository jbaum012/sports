<template>
  <div
    :style="{ borderBottom: '5px solid ' + team.secondary_color, background: team.primary_color }"
    class="p-1 font-bold text-white inline-block items-center text-lg"
  >
    {{ title || team.name }}
  </div>
</template>
<script>
export default {
  props: {
    team: Object,
    title: String
  }
}
</script>
