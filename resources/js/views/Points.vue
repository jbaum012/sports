<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-3" v-for="week in weeks" :key="week.id">
        <b-card :title="'Week: ' + week.number" class="mb-2">
          <b-table-simple>
            <b-thead>
              <b-tr>
                <b-th>User</b-th>
                <b-th>Score</b-th>
                <b-th>Winnings</b-th>
              </b-tr>
            </b-thead>
            <b-tbody>
              <b-tr
                v-for="score in week.user_scores"
                :key="score.user_id"
                :variant="week.winners.includes(score) ? 'success' : 'danger'"
              >
                <b-td>
                  <user-card
                    :user="getUser(score.user_id)"
                    size="sm"
                    variant="icon"
                  />
                </b-td>
                <b-td class="text-right"> {{ score.total }}</b-td>
                <b-td class="text-right">
                  {{ getWeeklyWinnings(week, score) }}
                </b-td>
              </b-tr>
            </b-tbody>
          </b-table-simple>
        </b-card>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import UserCard from '../components/UserCard'
export default {
  components: {
    UserCard
  },
  data() {
    return {
      weeks: [],
      userNames: []
    }
  },
  created() {
    axios.get('api/week').then(r => {
      this.weeks = r.data
      this.weeks.forEach(week => {
        week.user_scores = []
        for (const user in week.user_bets) {
          week.user_scores.push({
            user_id: user,
            total: this.processBetsScore(week.user_bets[user])
          })
        }
        week.user_scores.sort((a, b) => (a.total < b.total ? 1 : -1))
        week.winning_total = Math.max.apply(
          Math,
          week.user_scores.map(s => s.total)
        )
        week.winners = week.user_scores.filter(
          s => s.total === week.winning_total
        )
      })
    })
  },
  methods: {
    processBetsScore(bets) {
      let total = 0
      return bets
        .map(bet => parseInt(total) || 0 + parseInt(this.getScore(bet)))
        .reduce((sum, score) => sum + score)
    },
    getScore(bet) {
      if (!this.userNames[bet.user_id]) {
        this.userNames[bet.user_id] = {
          name: bet.user,
          avatar: bet.user_avatar
        }
      }
      const multiplyer = bet.double_down ? 2 : 1
      let score = 1 * multiplyer
      if (bet.won === null) {
        return 0
      }
      console.log(bet.team.name, bet.user, bet.won)
      return bet.won ? score : score * -1
    },
    getWeeklyWinnings(week, score) {
      if (!week.winners.some(winners => winners === score)) {
        return '-$2.00'
      }
      return '$' + (10 / week.winners.length).toFixed(2)
    },
    getUser(user_id) {
      return this.userNames[user_id]
    },
    rowVariant(score) {
      return score.includes('-') ? 'danger' : 'success'
    }
  }
}
</script>

<style scoped></style>
