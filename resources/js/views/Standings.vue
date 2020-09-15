<template>
  <div class="d-flex flex-column">
    <b-card
      class="mx-auto mb-2"
      v-for="(user, index) in sortedUsers"
      :key="user.id"
    >
      <user-card :user="user"
        >:<code>{{ user.points }}</code></user-card
      >
    </b-card>
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
      return this.users.sort((a, b) => a.points - b.points)
    }
  }
}
</script>

<style scoped></style>
