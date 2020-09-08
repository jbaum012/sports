<template>
  <b-col :cols="size" class="bg-gray">
    <div class="p-3 border-right">
      <b-nav vertical>
        <b-nav-item :to="{ name: 'home' }">Home</b-nav-item>
        <b-nav-item
          v-for="week in weeks"
          :key="week"
          :to="{ name: 'week', params: { week } }"
          >Week {{ week }}</b-nav-item
        >
      </b-nav>
    </div>
  </b-col>
</template>

<script>
import axios from 'axios'
import { mapState, mapMutations } from 'vuex'
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
      weeks: 17
    }
  },
  mounted() {
    if (this.user === null) {
      axios.get('api/user').then(r => {
        this.setUser(r.data)
      })
    }
  },
  methods: {
    ...mapMutations(['setUser'])
  },
  computed: {
    ...mapState(['user'])
  }
}
</script>

<style scoped></style>
