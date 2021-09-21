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
          <div
            v-for="(week, index) in bets"
            :key="index"
          >
            <h1 class="text-4xl fong-medium text-gray-900 my-3">
              {{ week[0].group }}
            </h1>
            <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md grid grid-flow-row grid-cols-1 md:grid-cols-2 md:gap-10 gap-6">
              <div
                v-for="bet in week"
                :key="bet.id"
              >
                <div class="grid grid-cols-2 pb-6 border-b-2 border-black-200">
                  <div class="text-center text-lg flex">
                    <div
                      v-if="!bet.game.results"
                      class="h-full"
                    >
                      <div class="h-1/2 mb-1">
                        <button
                          class="mr-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded-lg"
                          @click="submitPick(bet, bet.game.home_team)"
                        >
                          pick
                        </button>
                      </div>
                      <div class="h-1/2 mb-1">
                        <button
                          class="mr-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded-lg"
                          @click="submitPick(bet, bet.game.away_team)"
                        >
                          pick
                        </button>
                      </div>
                    </div>
                    <sports-game-list-item
                      class="flex-grow"
                      :game="bet.game"
                    />
                  </div>
                  <div
                    v-if="bet.team !== null"
                    class="text-center text-md"
                  >
                    <sports-bet-pick
                      :bet="bet"
                      @doubled="(e)=> bet.doubled = e"
                    />
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
import SportsBetPick from './Partials/SportsBetPick.vue'
export default{
  components: {
    AppLayout,
    SportsGameListItem,
    SportsBetPick
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
    return {
      submitPick,
      gameDay,
      gameTime
    }
  }
}
</script>
