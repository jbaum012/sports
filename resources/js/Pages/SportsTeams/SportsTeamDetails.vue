<template>
  <app-layout>
    <template #header>
      <h2 class='font-semibold text-xl text-gray-800 leading-tight'>
        {{ team.name }}
      </h2>
    </template>
    <div>

    </div>
  </app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout'
import { defineComponent } from 'vue'
export default defineComponent({
  components: {
    AppLayout,
  },
  props: {
    team: Object
  },
})
</script>
