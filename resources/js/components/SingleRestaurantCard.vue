<template>
  <div class="card mt-2 mb-2">
    <img v-if="user.image" class="card-img-top" :src="user.image" alt=""/>
    <div class="card-body">
      <h4 class="card-title">{{ user.restaurant_name }}</h4>
      <h6><strong>Categoria: {{ category }}</strong></h6>
      <div class="card-text">{{ user.restaurant_phone }}</div>
      <router-link :to="{ name: 'single-post', params: {slug: user.slug} }" class="card-link">Leggi tutto</router-link>
    </div>
  </div>
</template>

<script>
export default {
  name: "SingleRestaurantCard",
  props: {
    user: Object
  },
  computed: {
    category() {
      return this.user.category ? this.user.category.name : "nessuna";
    }
  },
}
</script>

<style>

</style>