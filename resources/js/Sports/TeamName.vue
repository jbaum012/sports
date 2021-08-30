<template>
  <div
    :style="{ borderBottom: '5px solid ' + team.secondary_color, background: team.primary_color }"
    class="p-1 font-bold text-white flex items-center text-xl"
  >
    {{ team.name }}
  </div>
</template>
<script>
import { defineComponent } from 'vue'
export default defineComponent({
  props: {
    team: Object,
  },
})
</script>
