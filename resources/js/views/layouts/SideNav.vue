<template>
  <b-col :cols="size" class="bg-gray">
    <div class="p-3 border-right">
      <b-nav vertical>
        <b-nav-item :to="{ name: 'home' }">Home</b-nav-item>
        <b-nav-item :to="{ name: 'week', params: { week: currentWeek } }"
          >This Week (week {{ currentWeek }})</b-nav-item
        >
        <b-nav-form class="w-100">
          Find Week<v-select
            style="width:100%;"
            :options="weeksArray"
            @input="goToWeek"
          ></v-select>
        </b-nav-form>
      </b-nav>
    </div>
  </b-col>
</template>

<script>
import axios from 'axios'
export default {
  props: {
    size: {
      type: Number,
      default: 2
    }
  },
  data() {
    return {
      columnSize: this.size,
      currentWeek: null,
      weeks: 17
    }
  },
  beforeMount() {
    axios.get('/api/week').then(r => (this.currentWeek = r.data))
  },
  methods: {
    goToWeek(week) {
      this.$router.push({ name: 'week', params: { week } })
    }
  },
  computed: {
    weeksArray() {
      return Array.from({ length: this.weeks }, (_, i) => i + 1)
    }
  }
}
</script>

<style scoped></style>
