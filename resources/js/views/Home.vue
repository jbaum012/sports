<template>
  <div>
    <h1>Hello World</h1>
  </div>
</template>

<script>
import axios from 'axios'
import TeamCard from '../components/TeamCard.vue'
export default {
  components: {
    TeamCard
  },
  data() {
    return {
      games: []
    }
  },
  mounted() {
    axios.get('/api/week/1/games').then(r => (this.games = r.data))
  }
}
</script>

<style scoped></style>
