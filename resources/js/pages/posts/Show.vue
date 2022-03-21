<template>
  <div>
      <h1>Dettagli Post</h1>
      <h1>{{post.title}}</h1>
      <img :src="post.image" :alt="post.title">
      <p>{{post.content}}</p>
  </div>
</template>

<script>
// importo axios
import axios from 'axios';
export default {
data(){
    return {
        // post obj vuoto
        post:{}
    }
},
methods: {
    // chiamata axios che prende dati da rotta show 
    async getPostApi(){
        const res = await axios.get("/api/posts/" + this.$route.params.post);
        this.post = res.data;
    }
},
mounted(){
    this.getPostApi();
}
}
</script>

<style>

</style>