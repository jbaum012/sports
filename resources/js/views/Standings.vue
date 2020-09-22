<template>
  <div class="container">
    <b-card v-if="busy" class="mb-3" v-for="(n, index) in 5" :key="index">
      <b-row class="align-items-center mb-2">
        <b-col sm="12" md="3" class="d-flex justify-content-center align-items-center flex-column">
          <skeleton-loader height="75px" width="75px" border-radius="100%" />
          <div class="d-flex justify-content-around w-100 mt-2">
            <skeleton-loader height="40px" width="40px" border-radius="100%" />
            <skeleton-loader height="40px" width="40px" border-radius="100%" />
            <skeleton-loader height="40px" width="40px" border-radius="100%" />
            <skeleton-loader height="40px" width="40px" border-radius="100%" />
            <skeleton-loader height="40px" width="40px" border-radius="100%" />
            <skeleton-loader height="40px" width="40px" border-radius="100%" />
          </div>
        </b-col>
        <b-col sm="12" md="3" class="text-center">
          <b-card class="text-center">
            Weekly Rank
            <h2 class="text-center m-0">
              <skeleton-loader />
            </h2>
          </b-card>
        </b-col>
        <b-col sm="12" md="3" class="text-center">
          <b-card class="text-center">
            Weekly
            <h2 class="text-center m-0">
              <skeleton-loader />
            </h2>
          </b-card>
        </b-col>
        <b-col sm="12" md="3" class="text-center">
          <b-card class="text-center">
            Overall
            <h2 class="text-center m-0">
              <skeleton-loader />
            </h2>
          </b-card>
        </b-col>
      </b-row>
      <skeleton-loader height="38px" border-radius="4px" width="100%" />
    </b-card>
    <b-card v-if="!busy" v-for="(user, index) in sortedUsers" :key="user.id" class="mb-2">
      <b-row class="align-items-center mb-2">
        <b-col sm="12" md="3" class="d-flex justify-content-center align-items-center flex-column">
          <user-card :user="user" size="lg" variant="icon"></user-card>
          <div class="d-flex justify-content-around w-100 mt-2">
            <user-achievement variant="golden_dick" :active="user === achievements.golden_dick" />
            <user-achievement variant="double_dude" :active="user === achievements.double_dude" />
            <user-achievement variant="this_is_fine" :active="user === achievements.this_is_fine" />
            <user-achievement variant="party_wolf" :active="user === achievements.party_wolf" />
            <user-achievement variant="poor" :active="user === achievements.poor" />
            <user-achievement variant="einstein" :active="user === achievements.einstein" />
          </div>
        </b-col>
        <b-col sm="12" md="3" class="text-center">
          <b-card class="text-center">
            Weekly Rank
            <h2 class="text-center m-0">{{ getRank(user.weekly_points) }}</h2>
          </b-card>
        </b-col>
        <b-col sm="12" md="3">
          <b-card class="text-center">
            Weekly
            <h2 class="text-center m-0">{{ points(user.weekly_points) }}</h2>
          </b-card>
        </b-col>
        <b-col sm="12" md="3">
          <b-card class="text-center">
            Overall
            <h2 class="text-center m-0">{{ user.points }}</h2>
          </b-card>
        </b-col>
      </b-row>
      <b-button v-b-toggle="'user-stats-' + user.id" variant="primary" block>Stats</b-button>
      <b-collapse :id="'user-stats-' + user.id" class="mt-2">
        <b-table-simple responsive striped>
          <b-tbody>
            <b-tr>
              <b-td class="text-right w-50 align-middle">Winnings:</b-td>
              <b-td class="text-left w-50">{{ winnings(user.winnings) }}</b-td>
            </b-tr>
            <b-tr>
              <b-td
                class="text-right w-50 align-middle"
                v-b-tooltip.right
                :title="
                  'Number of times ' +
                    user.name +
                    ' was the only one to win a bet'
                "
              >Lone Wolf:</b-td>
              <b-td class="text-left w-50">{{ user.lone_wolf }}</b-td>
            </b-tr>
            <b-tr>
              <b-td
                class="text-right w-50 align-middle"
                v-b-tooltip.right
                :title="
                  'Number of times ' +
                    user.name +
                    ' was the only one to lose a bet'
                "
              >Loan Wolf:</b-td>
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
              >Dicked:</b-td>
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
              >200 IQ play:</b-td>
              <b-td class="text-left w-50">{{ user['200_iq'] }}</b-td>
            </b-tr>
            <b-tr>
              <b-td
                class="text-right w-50 align-middle"
                v-b-tooltip.right
                :title="
                  'Number of times ' + user.name + ' successfully doubled down'
                "
              >Double Do:</b-td>
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
              >Double Don't:</b-td>
              <b-td class="text-left w-50">{{ user.double_dont }}</b-td>
            </b-tr>
            <b-tr>
              <b-td
                class="text-right w-50 align-middle"
                v-b-tooltip.right
                :title="'Team that has won ' + user.name + ' the most points'"
              >Strong Arm:</b-td>
              <b-td class="text-left w-50 align-middle">
                <team-card
                  v-if="user.strong_arm !== null"
                  :team="user.strong_arm.team"
                  :score="user.strong_arm.score"
                  variant="left"
                ></team-card>
                <span v-else class="text-muted">N/A</span>
              </b-td>
            </b-tr>
            <b-tr>
              <b-td
                class="text-right w-50 align-middle"
                v-b-tooltip.right
                :title="'Team that has lost ' + user.name + ' the most points'"
              >Limp Dick:</b-td>
              <b-td class="text-left w-50 align-middle">
                <team-card
                  v-if="user.limp_dick !== null"
                  :team="user.limp_dick.team"
                  :score="user.limp_dick.score"
                  variant="left"
                ></team-card>
                <span v-else class="text-muted">N/A</span>
              </b-td>
            </b-tr>
            <b-tr>
              <b-td
                class="text-right w-50 align-middle"
                v-b-tooltip.right
                :title="'Team that ' + user.name + ' has picked the most'"
              >Favorite Team:</b-td>
              <b-td class="text-left w-50 align-middle">
                <team-card
                  v-if="user.favorite_team !== null"
                  :team="user.favorite_team.team"
                  :score="user.favorite_team.score"
                  variant="left"
                ></team-card>
                <span v-else class="text-muted">N/A</span>
              </b-td>
            </b-tr>
            <b-tr>
              <b-td
                class="text-right w-50 align-middle"
                v-b-tooltip.right
                :title="'Team that ' + user.name + ' has bet against the most'"
              >Rejected:</b-td>
              <b-td class="text-left w-50 align-middle">
                <team-card
                  v-if="user.rejected !== null"
                  :team="user.rejected.team"
                  :score="user.rejected.score"
                  variant="left"
                ></team-card>
                <span v-else class="text-muted">N/A</span>
              </b-td>
            </b-tr>
            <b-tr>
              <b-td
                class="text-right w-50 align-middle"
                v-b-tooltip.right
                title="Are you beating Tony?"
              >Better than tony?</b-td>
              <b-td class="text-left w-50">
                <div v-if="user.name !== 'Tony Vetter'">
                  <h2 v-if="user.better_than_tony" class="m-0">🏆</h2>
                  <h2 v-else class="m-0">💩</h2>
                </div>
                <h2 v-else class="m-0" v-b-tooltip.right title="Tony #1 in our hearts">❤️</h2>
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
import SkeletonLoader from '../components/SkeletonLoader.vue'
import UserAchievement from '../components/UserAchievement.vue'
import orderBy from 'lodash.orderby'
export default {
  components: {
    UserCard,
    TeamCard,
    SkeletonLoader,
    UserAchievement
  },
  data() {
    return {
      users: [],
      busy: true
    }
  },
  beforeMount() {
    axios.get('/api/standings').then((r) => {
      this.users = r.data
      this.busy = false
    })
  },
  computed: {
    sortedUsers() {
      return orderBy(this.users, 'weekly_points', 'desc')
    },
    achievements() {
      return {
        golden_dick: this.getMax('dicked'),
        double_dude: this.getMax('double_do'),
        this_is_fine: this.getMax('double_dont'),
        party_wolf: this.getMax('lone_wolf'),
        poor: this.getMax('loan_wolf'),
        einstein: this.getMax('200_iq')
      }
    },
    scores() {
      return this.users
        .map((u) => u.weekly_points)
        .sort()
        .reverse()
    }
  },
  methods: {
    winnings(cents) {
      let money = cents / 100
      return money.toLocaleString('en-US', {
        style: 'currency',
        currency: 'USD'
      })
    },
    points(value) {
      if (value > 0) {
        return '+' + value
      }
      return value
    },
    getMax(property) {
      let max = Math.max(...this.users.map((u) => u[property]))
      return this.users.filter((user) => {
        return user[property] === max
      })[0]
    },
    getRank(weeklyScore) {
      return this.scores.indexOf(weeklyScore) + 1
    }
  }
}
</script>

<style scoped lang="scss">
.achievement {
  max-width: 40px;
}
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
