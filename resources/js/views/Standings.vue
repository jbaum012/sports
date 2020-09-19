<template>
  <div>
    <b-card v-for="(user, index) in sortedUsers" :key="user.id">
      <b-row class="align-items-center mb-2">
        <b-col
          sm="12"
          md="3"
          class="d-flex justify-content-center align-items-center"
        >
          <user-card
            :user="user"
            size="lg"
            variant="icon"
            class="mx-right"
          ></user-card>
        </b-col>
        <b-col sm="12" md="3" class="text-center">
          <b-card class="text-center">
            Rank
            <h2 class="text-center m-0">{{ index + 1 }}</h2>
          </b-card>
        </b-col>
        <b-col sm="12" md="3">
          <b-card class="text-center">
            Weekly
            <h2 class="text-center m-0">
              {{ points(user.weekly_points) }}
            </h2>
          </b-card>
        </b-col>
        <b-col sm="12" md="3">
          <b-card class="text-center">
            Overall
            <h2 class="text-center m-0">{{ user.points }}</h2>
          </b-card>
        </b-col>
      </b-row>
      <b-button v-b-toggle="'user-stats-' + user.id" variant="primary" block
        >Stats</b-button
      >
      <b-collapse :id="'user-stats-' + user.id" class="mt-2">
        <b-table-simple responsive striped>
          <b-tbody>
            <b-tr>
              <b-td
                class="text-right w-50 align-middle"
                v-b-tooltip.right
                :title="
                  'Number of times ' +
                    user.name +
                    ' was the only won to win a bet'
                "
                >Lone Wolf:</b-td
              >
              <b-td class="text-left w-50">{{ user.lone_wolf }}</b-td>
            </b-tr>
            <b-tr>
              <b-td
                class="text-right w-50 align-middle"
                v-b-tooltip.right
                :title="
                  'Number of times ' +
                    user.name +
                    ' was the only won to lose a bet'
                "
                >Loan Wolf:</b-td
              >
              <b-td class="text-left w-50">{{ user.loan_wolf }}</b-td>
            </b-tr>
            <b-tr>
              <b-td
                class="text-right w-50 align-middle"
                v-b-tooltip.right
                :title="
                  'Number of times ' +
                    user.name +
                    '\'s pick won the game but lost the spread'
                "
                >Dicked:</b-td
              >
              <b-td class="text-left w-50">{{ user.dicked }}</b-td>
            </b-tr>
            <b-tr>
              <b-td
                class="text-right w-50 align-middle"
                v-b-tooltip.right
                :title="
                  'Number of times ' +
                    user.name +
                    '\'s pick lost the game but won the spread'
                "
                >200 IQ play:</b-td
              >
              <b-td class="text-left w-50">{{ user['200_iq'] }}</b-td>
            </b-tr>
            <b-tr>
              <b-td
                class="text-right w-50 align-middle"
                v-b-tooltip.right
                :title="
                  'Number of times ' + user.name + ' successfully doubled down'
                "
                >Double Do:</b-td
              >
              <b-td class="text-left w-50">{{ user.double_do }}</b-td>
            </b-tr>
            <b-tr>
              <b-td
                class="text-right w-50 align-middle"
                v-b-tooltip.right
                :title="
                  'Number of times ' +
                    user.name +
                    ' unsuccessfully doubled down'
                "
                >Double Don't:</b-td
              >
              <b-td class="text-left w-50">{{ user.double_dont }}</b-td>
            </b-tr>
            <b-tr>
              <b-td
                class="text-right w-50 align-middle"
                v-b-tooltip.right
                :title="'Team that has won ' + user.name + ' the most points'"
                >Strong Arm:</b-td
              >
              <b-td class="text-left w-50 align-middle">
                <team-card
                  v-if="user.strong_arm !== null"
                  :team="user.strong_arm"
                ></team-card>
                <span v-else class="text-muted">N/A</span>
              </b-td>
            </b-tr>
            <b-tr>
              <b-td
                class="text-right w-50 align-middle"
                v-b-tooltip.right
                :title="'Team that has lost ' + user.name + ' the most points'"
                >Limp Dick:</b-td
              >
              <b-td class="text-left w-50 align-middle">
                <team-card
                  v-if="user.limp_dick !== null"
                  :team="user.limp_dick"
                ></team-card>
                <span v-else class="text-muted">N/A</span>
              </b-td>
            </b-tr>
            <b-tr>
              <b-td
                class="text-right w-50 align-middle"
                v-b-tooltip.right
                :title="'Team that ' + user.name + ' has picked the most'"
                >Favorite Team:</b-td
              >
              <b-td class="text-left w-50 align-middle">
                <team-card
                  v-if="user.favorite_team !== null"
                  :team="user.favorite_team"
                ></team-card>
                <span v-else class="text-muted">N/A</span>
              </b-td>
            </b-tr>
            <b-tr>
              <b-td
                class="text-right w-50 align-middle"
                v-b-tooltip.right
                :title="'Team that ' + user.name + ' has bet against the most'"
                >BE GONE:</b-td
              >
              <b-td class="text-left w-50 align-middle">
                <team-card
                  v-if="user.be_gone !== null"
                  :team="user.be_gone"
                ></team-card>
                <span v-else class="text-muted">N/A</span>
              </b-td>
            </b-tr>
            <b-tr>
              <b-td
                class="text-right w-50 align-middle"
                v-b-tooltip.right
                title="Are you beating Tony?"
                >Better than tony?</b-td
              >
              <b-td class="text-left w-50">
                <h2 v-if="user.better_than_tony" class="m-0">🏆</h2>
                <h2 v-else class="m-0">💩</h2>
              </b-td>
            </b-tr>
          </b-tbody>
        </b-table-simple>
      </b-collapse>
    </b-card>
  </div>
</template>

<script>
import axios from 'axios'
import UserCard from '../components/UserCard.vue'
import TeamCard from '../components/TeamCard.vue'
import orderBy from 'lodash.orderby'
export default {
  components: {
    UserCard,
    TeamCard
  },
  data() {
    return {
      users: []
    }
  },
  beforeMount() {
    axios.get('/api/standings').then(r => {
      this.users = r.data
    })
  },
  computed: {
    sortedUsers() {
      return orderBy(this.users, 'points', 'desc')
    }
  },
  methods: {
    points(value) {
      if (value > 0) {
        return '+' + value
      }
      return value
    }
  }
}
</script>

<style scoped lang="scss">
.point-box {
  border: 2px solid black;
  text-align: center;
  &__title {
    border-bottom: 2px solid black;
    font-size: 2rem;
    width: 100%;
  }
  &__score {
    font-size: 2rem;
    color: #31ca5a;
  }
}
</style>
