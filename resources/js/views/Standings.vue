<template>
  <b-container fluid>
    <b-row cols="2">
      <b-col v-for="(user, index) in sortedUsers" :key="user.id">
        <b-card class="mx-auto mb-2">
          <user-card :user="user" size="lg">
            <code>{{ user.points }}</code>
          </user-card>
        </b-card>
      </b-col>
    </b-row>
  </b-container>
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
    axios.get('/api/standings').then((r) => {
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
