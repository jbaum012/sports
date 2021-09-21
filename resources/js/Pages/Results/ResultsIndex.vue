<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Picks
      </h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-flow-row grid-cols-1">
          <div v-if="bets.length === 0">
            Check back once some games finish
          </div>
          <div
            v-for="(week, index) in bets"
            :key="index"
          >
            <h1 class="text-4xl fong-medium text-gray-900 my-3">
              {{ week[0].group }}
            </h1>
            <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md grid grid-flow-row grid-cols-1 md:grid-cols-2 md:gap-10 gap-6">
              <div class="md:col-span-2 text-2xl border-b-2 border-black-200 mb-1 pb-1">
                Total Score: {{ pointsSum(week) }}
              </div>
              <div
                v-for="bet in week"
                :key="bet.id"
              >
                <div class="grid grid-cols-2 pb-6 border-b-2 border-black-200">
                  <div class="text-center text-lg flex">
                    <sports-game-list-item
                      class="flex-grow"
                      :game="bet.game"
                    />
                  </div>
                  <div class="text-center text-md">
                    <sports-bet-results :bet="bet" />
                  </div>
                </div>
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
import SportsGameListItem from '@/Sports/SportsGameListItem.vue'
import { gameDay, gameTime } from '@/helpers.js'
import SportsBetResults from './Partials/SportsBetResults.vue'

export default{
  components: {
    AppLayout,
    SportsGameListItem,
    SportsBetResults
  },
  props:['bets'],
  setup(props) {
    const submitPick = async (bet, team) => {
      await axios.put(route('submit-pick', {
        bet: bet.id,
        sports_team_id: team.id
      }));
      bet.team = team
    };
    const pointsSum = (group) => {
      const total = group.reduce((a, b) => {
        return {
          points: a.points + b.points
        }
      }).points
      return Math.round((total + Number.EPSILON) * 100) / 100
    }
    return {
      submitPick,
      pointsSum,
      gameDay,
      gameTime
    }
  }
}
</script>
