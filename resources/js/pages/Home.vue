<template>
  <div>
    <h1>Boolpress</h1>
    <!-- paginazione di bootstrap -->
    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li class="page-item">
          <!-- al click il current page va a -1 -->
          <a class="page-link" @click="postsApi(pagination.current_page - 1)"
            >Previous</a
          >
        </li>
        <li class="page-item" v-for="page in pagination.last_page" :key="page">
          <!-- al click assegnerà la pagina desiderata -->
          <a class="page-link" @click="postsApi(page)">{{ page }}</a>
        </li>
        <li class="page-item">
          <!-- al click il current page va a +1 -->
          <a class="page-link" @click="postsApi(pagination.current_page + 1)"
            >Next</a
          >
        </li>
      </ul>
    </nav>
    <div class="row row-cols-1 row-cols-md-2 g-4">
      <PostCard v-for="post of posts" :key="post.id" :post="post"> </PostCard>
    </div>
  </div>
</template>

<script>
// import Axios
import axios from "axios";
// importo PostCard
import PostCard from "../components/PostCard.vue";
export default {
  components: {
    PostCard,
  },
  data() {
    return {
      // array di post
      posts: [],
      // oggetto vuoto
      pagination: {},
    };
  },
  methods: {
    // assegnavo valore di default alla pagina 1
    postsApi(page = 1) {
      // se pagina va a -1 allora va all'ultina
      if (page < 1) {
        page = this.pagination.last_page;
      }
      // se pagina va oltre la fine , torna all'inizio
      if (page > this.pagination.last_page) {
        page = this.pagination.first_page;
      }
      // modificato la query e  inserito la pagina
      axios.get("/api/posts?page=" + page).then((res) => {
        // mi salvo tutti i dati della paginazione
        this.pagination = res.data;
        // facendo la paginazione i dati dei post saranno in data.data
        this.posts = res.data.data;
      });
    },
  },
  mounted() {
    this.postsApi();
  },
};
</script>

<style>
</style>