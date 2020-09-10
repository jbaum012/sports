<template>
  <b-container fluid>
    <h1>Everyone's picks</h1>
    <!-- TODO: completely rethink this component -->
    <b-row cols="1">
      <b-col v-for="(week, index) in betsByWeek" :key="index">
        <b-card no-body class="mb-1">
          <b-card-header header-tag="header" class="p-1" role="tab">
            <b-button
              block
              v-b-toggle="'collapse' + index"
              :variant="index == currentWeek ? 'primary' : 'secondary'"
              >Week {{ index }}</b-button
            >
          </b-card-header>
          <b-collapse
            :id="'collapse' + index"
            :visible="index == currentWeek"
            role="tabpanel"
          >
            <b-card-body>
              <table class="table">
                <thead>
                  <tr>
                    <th>Picked By</th>
                    <th>Home Team</th>
                    <th>Away Team</th>
                    <th>Picked By</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="game in week" :key="game.id">
                    <td>
                      <span class="mr-1" v-for="bet in game.home_bets">
                        <img
                          :id="bet.user + bet.id"
                          :style="{
                            boxShadow: bet.won ? '0 0 0 2px green' : 'none'
                          }"
                          class="img-fluid rounded-circle avatar"
                          :src="bet.user_avatar"
                        />
                        <b-tooltip :target="bet.user + bet.id" triggers="hover">
                          {{ bet.user }}
                        </b-tooltip>
                      </span>
                    </td>
                    <td>
                      <team-card :team="game.home_team"></team-card>
                    </td>
                    <td>
                      <team-card :team="game.away_team"></team-card>
                    </td>
                    <td>
                      <span class="mr-1" v-for="bet in game.away_bets">
                        <img
                          :id="bet.user + bet.id"
                          :style="{
                            boxShadow: bet.won ? '0 0 0 5px green' : 'none'
                          }"
                          class="img-fluid rounded-circle avatar"
                          :src="bet.user_avatar"
                        />
                        <b-tooltip :target="bet.user + bet.id" triggers="hover">
                          {{ bet.user }}
                        </b-tooltip>
                      </span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </b-card-body>
          </b-collapse>
        </b-card>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import axios from 'axios'
import { mapState } from 'vuex'
import TeamCard from '../components/TeamCard'
export default {
  components: {
    TeamCard
  },
  mounted() {
    axios.get('/api/games').then(r => {
      this.betsByWeek = r.data
    })
  },
  data() {
    return {
      betsByWeek: []
    }
  },
  computed: {
    ...mapState(['currentWeek'])
  }
}
</script>

<style scoped>
.avatar {
  max-width: 40px;
}
</style>
