<template>
  <div>
    <h1 class="d-flex">
      Week {{ week }}
      <b-button class="ml-auto mr-2" varient="primary" v-b-modal.new-game-modal
        >Add Game</b-button
      >
    </h1>
    <b-table-simple responsive bordered>
      <b-thead>
        <b-tr>
          <b-th scope="col">My Pick</b-th>
          <b-th scope="col">Teams</b-th>
          <b-th scope="col">Spread</b-th>
          <!-- <b-th scope="col">Score</b-th> -->
          <b-th scope="col"></b-th>
        </b-tr>
      </b-thead>
      <b-tbody v-if="!busy">
        <template v-for="(games, index) in groupedGames">
          <b-tr class="bg-dark text-white"
            ><b-td colspan="4"
              ><span>{{ weekDisplay(index) }}</span></b-td
            ></b-tr
          >
          <betting-card
            v-for="game in games"
            :key="game.id"
            :game="game"
            @deleted="fetchData"
          />
        </template>
      </b-tbody>
      <b-tbody v-else>
        <b-tr v-for="(n, index) in 7" :key="index">
          <b-td v-for="(m, index) in 4" :key="index">
            <skeleton-loader
              height="40px"
              width="100%"
              :random-width="false"
            ></skeleton-loader>
          </b-td>
        </b-tr>
      </b-tbody>
    </b-table-simple>
    <b-modal
      id="new-game-modal"
      title="Game"
      size="lg"
      hide-footer
      :no-close-on-backdrop="true"
    >
      <game-form @saved="newGameAdded"></game-form>
    </b-modal>
  </div>
</template>

<script>
import axios from 'axios'
import { mapState, mapMutations } from 'vuex'
import BettingCard from '../components/BettingCard.vue'
import GameForm from '../components/GameForm.vue'
import moment from 'moment'
import groupBy from 'lodash.groupby'
export default {
  components: {
    BettingCard,
    GameForm
  },
  props: {
    week: {
      type: Number,
      default: 1
    }
  },
  data() {
    return {
      gamesThisWeek: [],
      busy: true
    }
  },
  mounted() {
    this.fetchData()
  },
  computed: {
    ...mapState(['teams'])
  },
  methods: {
    fetchData() {
      axios
        .get(`/api/week/${this.week}/games`)
        .then(r => {
          this.gamesThisWeek = r.data
          if (this.teams === null || this.teams === undefined) {
            this.fetchTeams()
          }
        })
        .finally(() => {
          this.busy = false
        })
    },
    fetchTeams() {
      axios.get('/api/teams').then(r => this.setTeams(r.data))
    },
    newGameAdded() {
      this.$bvModal.hide('new-game-modal')
      this.fetchData()
    },
    weekDisplay(week) {
      return moment.utc(week).format('dddd, MMM Do h:mm a')
    },
    ...mapMutations(['setTeams'])
  },
  computed: {
    groupedGames() {
      return groupBy(this.gamesThisWeek, game => {
        return game.date
      })
    }
  },
  watch: {
    $route(newRoute, oldRoute) {
      if (newRoute.params !== oldRoute.params) {
        this.fetchData()
      }
    }
  }
}
</script>

<style scoped></style>
