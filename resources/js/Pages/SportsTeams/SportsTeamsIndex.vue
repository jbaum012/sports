<template>
  <app-layout>
    <template #header>
      <h2 class='font-semibold text-xl text-gray-800 leading-tight'>
        Teams
      </h2>
    </template>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
              <table class="table-auto">
                <thead>
                  <tr>
                    <th>Abbrivation</th>
                    <th>Name</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="team in teams"
                    :key="team.id"
                    >
                    <td>
                      <div class="font-bold text-center" :style="'border: 3px solid ' + team.secondary_color + ';color: ' + team.secondary_color + '; background-color: ' + team.primary_color">
                        {{ team.abbreviation }}
                      </div>
                    </td>
                    <td>{{ team.name }}</td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
            </div>
        </div>
    </div>
  </app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout'
export default {
  components: {
    AppLayout,
  },
  props: {
    teams: {
      type: Object,
      required: true
    }
  },
  setup(props) {
    const teams = props.teams
    console.log(teams[0])

    return {
      teams
    }
  }
}
</script>
