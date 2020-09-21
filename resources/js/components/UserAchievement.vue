<template>
  <img
    class="achievement img-fluid"
    :class="achievementClasses"
    :src="'/images/'+variant+'.png'"
    v-b-tooltip.auto
    :title="variantTitle"
  />
</template>

<script>
export default {
  props: {
    variant: {
      type: String,
      required: true
    },
    active: {
      type: Boolean,
      default: false
    }
  },
  computed: {
    achievementClasses() {
      return {
        active: this.active
      }
    },
    variantTitle() {
      let titles = {
        golden_dick: 'Golden Dick: being dicked the most',
        double_dude: 'Double Dude: most successful double downs',
        this_is_fine: 'This is fine: lease successful double downs',
        party_wolf: 'Party Wolf: most lone wolfs',
        poor: 'Poor: most loan wolfs',
        einstein: 'Big Brain: most 200 IQ plays'
      }
      return titles[this.variant]
    }
  }
}
</script>

<style lang="scss">
.achievement {
  opacity: 20%;
  max-width: 40px;
  &.active {
    opacity: 100%;
  }
}
</style>
