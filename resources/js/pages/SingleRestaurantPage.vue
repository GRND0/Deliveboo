<template>
  <div class="container">
    <section v-if="user">    
      <h1 class="mt-4">{{ user.restaurant_name }}</h1>
      <!-- <h6><strong>Categoria: {{ user.category }}</strong></h6> -->
      <div v-if="user.image">
        <img :src="user.image" alt=""/>
      </div>
      <p class="mt-2">{{ user.ingredients }}</p>  
    </section> 
    <section v-else><h2>Caricamento...</h2></section> 
  </div>
</template>

<script>
export default {
  name: "SingleRestaurantPage",
  data() {
    return {
      user: null,
    }
  },
  created() {
    this.getDetails();
  },
  computed: {
    // category() {
    //   return this.user.category ? this.user.category.name : "nessuna";
    // }
  },
  methods: {
    getDetails() {
      const slug = this.$route.params.slug;
      axios
        .get(`/api/users/${slug}`) //ricordare di mettere backtick
        .then((resp) => {
          if (resp.data.success) {
            this.user = resp.data.results;
          } else {
            this.$router.push({ name: "not-found" });
          }          
        })
    }
  }
}
</script>

<style>
</style>