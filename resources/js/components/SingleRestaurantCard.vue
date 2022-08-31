<template>
  <div class="card mt-2 mb-2">
    <img v-if="item.image" class="card-img-top" :src="item.image" alt=""/>
    <div class="card-body">
      <h4 class="card-title">{{ item.restaurant_name }}</h4>
      <h6><strong>Categoria: {{ category }}</strong></h6>
      <div class="card-text">{{ item.restaurant_phone }}</div>
      <router-link :to="{ name: 'single-post', params: {slug: item.slug} }" class="card-link">Leggi tutto</router-link>
    </div>
  </div>
</template>

<script>
export default {
  name: "SingleRestaurantCard",
  props: {
    item: Object
  },
  // computed: {
  //   category() {
  //     return this.item.category ? this.item.category.name : "nessuna";
  //   }
  // },
}
</script>

<style>

</style>