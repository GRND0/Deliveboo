<template>
  <div class="card mb-2">
    <router-link :to="{ name: 'restaurant', params: {slug: item.slug} }">
    <img v-if="item.image" class="card-img-top" :src="item.image" :alt="item.restaurant_name"/>
    <div class="card-body">
      <h4 class="card-title">{{ item.restaurant_name }}</h4>
      <h5 class="text-secondary">Tel: {{ item.restaurant_phone }}</h5>
      <h6 class="text-success">{{ item.address }}</h6>
      <div><a href="">{{ item.link_social_media }}</a></div>    
    </div>
    </router-link>
  </div>
</template>

<script>
export default {
  name: "SingleRestaurantCard",
  props: {
    item: Object,
  },
}
</script>

<style scoped>
</style>