<template>
  <span
    :style="{
      height,
      'border-radius': borderRadius,
      width: computedWidth
    }"
    class="skeleton-loader"
  />
</template>

<script>
export default {
  name: 'SkeletonLoader',

  props: {
    width: {
      // Make it possible to define a fixed
      // width instead of using a random one.
      default: null,
      type: String
    },
    maxWidth: {
      // The default maxiumum width is 100%.
      default: 100,
      type: Number
    },
    minWidth: {
      // Lines have a minimum width of 80%.
      default: 80,
      type: Number
    },
    randomWidth: {
      default: false,
      type: Boolean
    },
    height: {
      // Make lines the same height as text.
      default: '1em',
      type: String
    },
    borderRadius: {
      default: '2px',
      type: String
    }
  },

  computed: {
    mounted() {
      console.log('loaded skeleton')
    },
    computedWidth() {
      // Either use the given fixed width or
      // a random width between the given min
      // and max values.
      return this.randomWidth
        ? `${Math.floor(
            Math.random() * (this.maxWidth - this.minWidth) + this.minWidth
          )}%`
        : this.width
    }
  }
}
</script>

<style lang="scss" scoped>
.skeleton-loader {
  display: flex;
  vertical-align: middle;
  background-color: #dddbdd;
  position: relative;
  overflow: hidden;
  &::after {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    transform: translateX(-100%);
    background-image: linear-gradient(
      90deg,
      rgba(#fff, 0) 0,
      rgba(#fff, 0.2) 20%,
      rgba(#fff, 0.5) 60%,
      rgba(#fff, 0)
    );
    animation: shimmer 2s infinite;
    content: '';
  }
  @keyframes shimmer {
    100% {
      transform: translateX(100%);
    }
  }
}
</style>
