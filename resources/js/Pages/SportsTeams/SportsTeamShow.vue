<template>
  <app-layout>
    <template #header>
      <h2 class='font-semibold text-xl text-gray-800 leading-tight'>
        {{ team.name }}
      </h2>
    </template>
    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
          <sports-team-form :team="team" />
        </div>
    </div>
  </app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout'
import { defineComponent } from 'vue'
import SportsTeamForm from './Partials/SportsTeamForm.vue'
export default defineComponent({
  components: {
    AppLayout,
    SportsTeamForm
  },
  props: {
    team: Object
  },
})
</script>
