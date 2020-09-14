<template>
  <div class="d-flex flex-column">
    <b-card
      class="mx-auto mb-2"
      v-for="(user, index) in sortedUsers"
      :key="user.id"
    >
      <img style="width: 40px" :src="user.avatar" /> {{ user.name }}:
      <code>{{ user.points }}</code>
    </b-card>
  </div>
</template>

<script>
import axios from 'axios'
export default {
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
