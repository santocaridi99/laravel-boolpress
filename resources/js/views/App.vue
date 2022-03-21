<template>
  <div>
    <TheNavbar></TheNavbar>
    <div class="container py-4">
      <!-- router view -->
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
// importo navbar
import TheNavbar from "../components/TheNavbar.vue";
export default {
  // componenti
  components: {
    TheNavbar,
  },
};
</script>

<style lang="scss">
</style>