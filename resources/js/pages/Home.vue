<template>
<div class="container">
  <div class="row">
    <div class="col-12">
      <div class="container py-5">
        <h2 class="text-center pb-3">Cerca tra i migliori ristoranti nella tua zona!</h2>
        <div>
          <span>Filtra i ristoranti per categoria</span>
          <select name="categories" id="categories" @change="sendCategories">
            <option :value="category.id"
                    v-for="(category, index) in categories"
                    :key="index"
            >
              {{ category.name }}
            </option>
          </select>
          <RestaurantsList />
        </div>
      </div>
    </div>
  </div>
</div>

</template>

<script>
import axios from "axios";
import RestaurantsList from "../components/RestaurantsList.vue";


export default {
  name: "Home",
  components: { RestaurantsList },
  data() {
    return {
      categories: [],
      category: null,
    };
  },
  methods: {
    sendCategories(e) {
      console.log(e.target.value);
    },
  },
  created() {
    axios
      .get("/api/categories")
      .then((response)=> {
        this.categories = response.data;
      })
      .catch((error)=> {
        console.log(error);
      });
  },
};
</script>

<style lang="scss" scoped>
img {
  width: 30%;
  height: 15vh;
  object-fit: cover;
}
select {
  min-width: 100px;
}
</style>