<template>
  <span class="d-flex justify-content-betwee">
    <transition name="slide-fade" mode="out-in">
      <b-button
        size="sm"
        v-if="!openConfirm"
        :variant="displayVariant"
        @click.stop="openConfirm = true"
      >
        <b-icon-trash />
      </b-button>
      <div
        v-if="openConfirm"
        class="d-flex flex-grow align-items-center confirm-delete"
      >
        <div class="ml-auto mr-3">
          <span class="mr-2">{{ warning }}</span>
          <b-button
            class="mr-1"
            size="sm"
            variant="outline-danger"
            @click.stop="$emit('confirmed')"
          >
            Yes
          </b-button>
          <b-button
            size="sm"
            variant="outline-secondary"
            @click.stop="openConfirm = false"
          >
            No
          </b-button>
        </div>
      </div>
    </transition>
  </span>
</template>

<script>
export default {
  props: {
    displayVariant: {
      type: String,
      default: 'outline-secondary'
    },
    warning: {
      type: String,
      default: 'Are you sure?'
    }
  },

  data() {
    return {
      openConfirm: false
    }
  }
}
</script>
<style scoped>
.slide-fade-enter-active {
  transition: all 0.1s ease;
}
.slide-fade-leave-active {
  transition: all 0.1s ease;
}
.slide-fade-enter,
.slide-fade-leave-to {
  /* transform: translateX(-10px); */
  opacity: 0;
}
/* .confirm-delete {
  position: absolute;
  background: white;
  left: 0;
  top: 0;
  margin-left: auto;
  width: 100%;
  height: 100%;
} */
</style>
