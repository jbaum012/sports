<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Teams</h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <sports-table>
            <template #thead>
              <tr>
                <th>Abbrivation</th>
                <th>Name</th>
                <th>Actions</th>
              </tr>
            </template>
            <template #tbody>
              <tr v-for="team in teams" :key="team.id">
                <td>
                  <team-badge :team="team" />
                </td>
                <td>{{ team.name }}</td>
                <td></td>
              </tr>
            </template>
          </sports-table>
        </div>
      </div>
    </div>
  </app-layout>
</template>
<script>
  import AppLayout from '@/Layouts/AppLayout.vue'
  import SportsTable from '@/Components/Table.vue'
  import { defineComponent } from 'vue'
  import TeamBadge from '@/Sports/TeamBadge.vue'

  export default defineComponent({
    components: {
      AppLayout,
      SportsTable,
      TeamBadge,
    },
    props: {
      teams: {
        type: Object,
        required: true,
      },
    },
    setup(props) {
      const teams = props.teams
      console.log(teams[0])

      return {
        teams,
      }
    },
  })
</script>
