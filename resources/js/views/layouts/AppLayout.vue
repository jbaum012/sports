<template>
  <div>
    <b-navbar variant="faded" type="dark" class="bg-primary">
      <b-navbar-brand tag="h1" class="mb-0">Sports</b-navbar-brand>
    </b-navbar>
    <b-container fluid class="p-0">
      <b-row :no-gutters="true">
        <side-nav></side-nav>
        <b-col class="mt-3 ml-3">
          <router-view></router-view>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>
import SideNav from './SideNav.vue'
export default {
  components: {
    SideNav
  }
}
</script>

<style scoped></style>
