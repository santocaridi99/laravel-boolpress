<template>
  <div>
    <TheNavbar></TheNavbar>
    <h1>Boolpress</h1>
    <ExampleComponent></ExampleComponent>
  </div>
</template>

<script>
// importo il componente di esemoio
import ExampleComponent from "../components/ExampleComponent.vue";
// importo navbar
import TheNavbar from "../components/TheNavbar.vue";
export default {
  // componenti
  components: {
    ExampleComponent,
    TheNavbar
  },
};
</script>

<style lang="scss">
</style>