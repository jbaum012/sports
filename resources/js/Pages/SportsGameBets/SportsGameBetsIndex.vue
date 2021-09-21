<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Bets for Game
      </h2>
    </template>
    <div class="py-5">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-flow-row grid-cols-1">
          <div class="text-3xl text-center mb-2">
            <div class="text-base mb-1">
              {{ game.group }}
            </div>
            <team-name
              class="text-3xl"
              :team="game.home_team"
            />
            <span class="block sm:inline-block">vs</span>
            <team-name
              class="text-3xl"
              :team="game.away_team"
            />
          </div>
          <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md grid grid-flow-row grid-cols-1 md:grid-cols-2 md:gap-10 gap-6">
            <table>
              <tbody>
                <tr
                  v-for="bet in bets"
                  :key="bet.id"
                >
                  <td>{{ bet.user.name }}</td>
                  <td>
                    <team-name
                      v-if="bet.team"
                      :team="bet.team"
                      :title="bet.team.abbreviation"
                    />
                    <span v-else>[no pick]</span>
                  </td>
                  <td>
                    <div
                      v-if="bet.doubled"
                      class="text-center block m-auto bg-green-500 text-white font-bold py-1 px-2 rounded-lg"
                    >
                      doubled
                    </div>
                  </td>
                  <td v-if="bet.points">
                    <span v-if="bet.points > 0">+</span>{{ bet.points }}
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout'
import TeamName from '../../Sports/TeamName.vue'
export default {
  components: {
    AppLayout,
    TeamName,
  },
  props: [
    'game',
    'bets'
  ],
  setup() {
  }
}
</script>
