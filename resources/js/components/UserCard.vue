<template>
  <div class="d-flex align-items-center">
    <img
      ref="avatar"
      :class="{ 'outline-avatar': highlight }"
      :style="avatarStyles"
      class="img-fluid rounded-circle avatar"
      :src="user.avatar"
    />
    <b-tooltip :target="() => $refs['avatar']" triggers="hover">{{ user.name }}</b-tooltip>
    <span v-if="variant !== 'icon'" :style="nameStyles">{{ user.name }}</span>
    <slot v-if="variant !== 'icon'"></slot>
  </div>
</template>

<script>
export default {
  props: {
    user: {
      type: Object,
      required: true
    },
    highlight: {
      type: Boolean,
      default: false
    },
    variant: {
      type: String,
      default: 'default'
    },
    size: {
      type: String,
      default: 'md'
    }
  },
  computed: {
    avatarSize() {
      let sizes = {
        '': '25px',
        sm: '30px',
        md: '50px',
        lg: '75px',
        xl: '180px'
      }
      return sizes[this.size]
    },
    margin() {
      let sizes = {
        '': '2px',
        sm: '5px',
        md: '10px',
        lg: '12px',
        xl: '15px'
      }
      return sizes[this.size]
    },
    nameSize() {
      let sizes = {
        '': '.5rem',
        sm: '.8rem',
        md: '1rem',
        lg: '2.2rem',
        xl: '4rem'
      }
      return sizes[this.size]
    },
    nameStyles() {
      return {
        'font-size': this.nameSize,
        'margin-right': this.margin
      }
    },
    avatarStyles() {
      return {
        'max-width': this.avatarSize,
        'margin-right': this.margin
      }
    }
  }
}
</script>

<style>
.outline-avatar {
  box-shadow: 0 0 0 5px hotpink;
}
.avatar {
  max-width: 40px;
}
</style>
