<template>
  <div>
    <h1>{{ post.title }}</h1>
    <img :src="post.image" :alt="post.title" />
    <p>{{ post.content }}</p>
  </div>
</template>

<script>
// importo axios
import axios from 'axios';
export default {
data(){
    return {
        // post obj vuoto
        post:{},
    }
},
methods: {
    // chiamata axios che prende dati da rotta show 
    async getPostApi(){
        try{
            // prova ad eseguire questo codice
            const res = await axios.get("/api/posts/" + this.$route.params.post);
            this.post = res.data;
        }catch(er){
            // cattura l'errore
            // rimpiazza la rotta con quella di nome error
            // si usa router perchè rappresenta tutta l'istanza , non la singola rotta router
            this.$router.replace({name:"error"});
            alert(er);
        }
        
    }
},
mounted(){
    this.getPostApi();
}
}
</script>

<style>
</style>