<template>
  <div>
    <TheNavbar></TheNavbar>
    <div class="container py-4">
      <h1>Boolpress</h1>
       <div class="row row-cols-1 row-cols-md-2 g-4">
        <PostCard v-for="post of posts" :key="post.id" :post="post"> </PostCard>
      </div>
    </div>
  </div>
</template>

<script>
// importo axios
import axios from "axios";
// importo navbar
import TheNavbar from "../components/TheNavbar.vue";
// importo Post Card
import PostCard from "../components/PostCard.vue"
export default {
  // componenti
  components: {
    TheNavbar,
    PostCard
  },
  data(){
    return{
      // array di post
      posts:[],
    }
  },
  methods:{
    postsApi(){
      axios.get("/api/posts").then((res)=>{
        this.posts=res.data;
      })
    }
  },
  mounted(){
    this.postsApi();
  }
};
</script>

<style lang="scss">
</style>