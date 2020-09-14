<template>
  <div class="d-flex flex-column">
    <b-card class="mx-auto mb-3" v-for="(user, index) in users" :key="user.id">
      <img style="width: 45px" :src="user.avatar" /> {{ user.name }}
      {{ user.points }}
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
  }
}
</script>

<style scoped></style>
