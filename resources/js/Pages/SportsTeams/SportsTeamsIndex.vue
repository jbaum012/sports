<template>
  <app-layout title="Teams">
    <template #header>
      <page-header>Teams</page-header>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-flow-row grid-cols-1 gap-4">
          <div
            v-for="(division, index) in divisions"
            :key="division"
          >
            <h1 class="text-lg fong-medium text-gray-900 mb-3">
              {{ index }}
            </h1>
            <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
              <div
                v-for="team in division"
                :key="team.id"
                class="flex mb-1"
              >
                <div class="my-auto">
                  {{ team.location }} {{ team.name }}
                </div>
                <inertia-link
                  class="ml-auto"
                  :href="route('teams.show', team.name.toLowerCase())"
                >
                  <jet-button class="bg-blue-300">
                    View
                  </jet-button>
                </inertia-link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout.vue'
import PageHeader from '@/Elements/PageHeader.vue'
import JetButton from '@/Jetstream/Button.vue'
import { Link as InertiaLink } from '@inertiajs/inertia-vue3'
import { defineComponent } from 'vue'
export default defineComponent({
  components: {
    AppLayout,
    PageHeader,
    JetButton,
    InertiaLink
  },
  props: {
    divisions: Object
  }
})
</script>
