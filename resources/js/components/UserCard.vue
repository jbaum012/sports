<template>
  <div>
    <img
      ref="avatar"
      :class="{ outlineAvatar: highlight }"
      class="img-fluid rounded-circle avatar"
      :src="user.avatar"
    />
    <b-tooltip :target="() => $refs['avatar']" triggers="hover">
      {{ user.name }}
    </b-tooltip>
    <span v-if="variant !== 'icon'">{{ user.name }}</span>
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
    }
  }
}
</script>

<style>
.oultine-avatar {
  outline: 0 0 0 5px hotpink;
}
.avatar {
  max-width: 40px;
}
</style>
