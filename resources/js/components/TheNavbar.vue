<template>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="/">Laravel Boolpress</a>

      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-bs-controls="navbarSupportedContent"
        aria-bs-expanded="false"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav ms-auto">
          <li class="nav-item" v-for="route in routes" :key="route.path">
            <!-- nel to uso un if ternario per evitare il doppio slash -->
            <!-- se non c'è un rpute . path inserisco lo slash altromenti do route.path -->
            <router-link :to="!route.path ? '/' : route.path" class="nav-link">
              {{ route.meta.link }}
            </router-link>
          </li>
        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <!-- se non è loggato rotta login - se non ho un utente-->
            <a class="nav-link" href="/login" v-if="!user"> Login </a>
            <!-- se loggato va in area riservata -->
            <a class="nav-link" href="/admin" v-else> {{ user.name }} </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      // inserirò le rotte già registrate in modo globale
      routes: [],
      // utente
      // di default non  è loggato
      user: null,
    };
  },
  methods: {
    getUser() {
      axios
        .get("/api/user")
        .then((res) => {
          this.user = res.data;
        })
        .catch((er) => {
          console.log("Utente non trovato");
        });
    },
  },
  mounted() {
    // $routes istanza globale in routes.js
    // filtro per quelle che hanno un link page
    // !! doppia negazione , torna true
    this.routes = this.$router.getRoutes().filter((route) => !!route.meta.link);
    // avvio get user
    this.getUser();
  },
};
</script>

<style></style>