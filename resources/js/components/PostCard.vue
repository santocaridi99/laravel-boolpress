<template>
  <div class="col">
    <div class="card">
      <img :src="getimage(post)" class="card-img-top" alt="..." />
      <div class="card-body">
        <h5 class="card-title">{{ post.title }}</h5>
        <!-- content può essere un html -->
        <p class="card-text" v-html="post.content"></p>

        <em>Autore: {{ post.user.name }}; Data: {{ post.created_at }}</em
        ><br />
        <!-- se c'è la categoria , stampa il titolo -->
        <p v-if="post.category">{{ post.category.title }}</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
props:{
    // passo ogg post
    post:Object,
},
methods:{
    getimage(post){
        if(post.image===null){
            return "https://blumagnolia.ch/wp-content/uploads/2021/05/placeholder-126-300x200.png"
        }else{
            return post.image
        }
    }
}
}
</script>

<style>

</style>