<template>
  <div>
    <h1 class="d-flex">
      Week {{ week }}
      <b-button class="ml-auto mr-2" varient="primary">Add Game</b-button>
    </h1>
  </div>
</template>

<script>
export default {
  props: {
    week: {
      type: Number,
      required: true
    }
  }
}
</script>

<style scoped></style>
