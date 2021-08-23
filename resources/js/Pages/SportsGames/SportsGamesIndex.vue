<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold flex text-xl text-gray-800 leading-tight">
        Games
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
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-flow-row grid-cols-1 gap-4">
          <div
            v-for="(week, index) in gamesByWeek"
            :key="index"
          >
            <h1 class="text-lg fong-medium text-gray-900 mb-3">
              {{ week[0].group }}
            </h1>
            <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md grid grid-flow-row grid-cols-1 gap-4 md:grid-cols-2">
              <sports-game-list-item
                v-for="game in week"
                :key="game.id"
                :game="game"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout'
import { defineComponent, ref } from 'vue'
import SportsGameListItem from './Partials/SportsGameListItem.vue'
import JetButton from '@/Jetstream/Button.vue'
import { Link } from '@inertiajs/inertia-vue3'

export default defineComponent({
  components: {
    AppLayout,
    SportsGameListItem,
    JetButton,
    Link
  },
  props:['gamesByWeek'],
  // setup(props) {
  //   props.gamesByWeek.reverse()
  // }
})
</script>
