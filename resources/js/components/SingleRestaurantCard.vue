<template>
  <div class="card mb-2">
    <img v-if="item.image" class="card-img-top" :src="item.image" :alt="item.restaurant_name"/>
    <div class="card-body">
      <h4 class="card-title">{{ item.restaurant_name }}</h4>
      <!-- <h6><strong>Categoria: {{ item.categories }}</strong></h6> -->
      <div class="card-text">{{ item.restaurant_phone }}</div>
      <router-link :to="{ name: 'single-post', params: {slug: item.slug} }" class="card-link">Vai al menu e ordina i tuoi piatti preferiti!</router-link>
    </div>
  </div>
</template>

<script>
export default {
  name: "SingleRestaurantCard",
  props: {
    item: Object,
  },
  // computed: {
  //   category() {
  //     return this.item.category ? this.item.category.name : "nessuna";
  //   }
  // },
}
</script>

<style scoped>

</style>