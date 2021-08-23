<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight flex">
        Add Game
        <Link
          class="ml-auto"
          :href="route('games.create')"
        >
          <jet-button class="bg-blue-300">
            Add Game
          </jet-button>
        </Link>
      </h2>
    </template>
    <div>
      <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div>
          <scores-form :game="game" />
          <jet-section-border />
        </div>
        <sports-game-form
          :game="game"
          :weeks="groups"
          :teams="teams"
        />
      </div>
    </div>
  </app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout'
import { defineComponent } from 'vue'
import SportsGameForm from './Partials/SportsGameForm.vue'
import ScoresForm from './Partials/ScoresForm.vue'
import JetButton from '@/Jetstream/Button.vue'
import { Link } from '@inertiajs/inertia-vue3'
import JetSectionBorder from '@/Jetstream/SectionBorder.vue'

export default defineComponent({
  components: {
    AppLayout,
    SportsGameForm,
    JetButton,
    Link,
    ScoresForm,
    JetSectionBorder,
  },
  props: {
    game: Object,
    groups: Array,
    teams: Array,
  },
})
</script>
