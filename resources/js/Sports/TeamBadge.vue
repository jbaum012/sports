<template lang="vue-html">
  <div class="font-bold text-center w-14 h-auto"
    :style="
      'border: 3px solid ' +
      team.secondary_color +
      ';color: white' +
      '; background-color: ' +
      team.primary_color
    ">
    {{ team.abbreviation }}
  </div>
</template>
<script>
  import { defineComponent } from '@vue/runtime-core'

  export default defineComponent({
    props: {
      team: {
        type: Object,
        required: true,
      },
    },
    setup(props) {
      const { team } = props
      return {
        team,
      }
    },
  })
</script>
