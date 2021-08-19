<template>
  <app-layout>
    <template #header>
      <h2 class='font-semibold text-xl text-gray-800 leading-tight'>
        Add Game
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
    game: Object
  }
})
</script>
