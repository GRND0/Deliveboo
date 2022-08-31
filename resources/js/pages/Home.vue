<template>
<div class="container">
  <div class="row">
    <div class="col-12">
      <div class="container py-5">
        <h2 class="text-center pb-3">Cerca tra i migliori ristoranti nella tua zona!</h2>
        <div>
          <!-- <label for="categories">Filtra i ristoranti per categoria</label>
          <select name="categories" id="categories" @change="categoriaSelezionata">
            <option :value="category.id"
                    v-for="(category, index) in categories"
                    :key="index"
            >
              {{ category.name }}
            </option>
          </select> -->
          <ListaRistoranti />
        </div>
      </div>
    </div>
  </div>
</div>

</template>

<script>
import axios from "axios";
import ListaRistoranti from "../components/ListaRistoranti.vue";


export default {
  name: "Home",
  components: { ListaRistoranti },
  data() {
    return {
      categories: [],
      category: null,
    };
  },
  // methods: {
  //   categoriaSelezionata(categoria) {
  //     this.categoriaRistorante = categoria;
  //     console.log("categoria id", categoria);
  //   },
  // },
  // created() {
  //   axios
  //     .get("/api/categories")
  //     .then((response)=> {
  //       this.categories = response.data;
  //     })
  //     .catch((error)=> {
  //       console.log(error);
  //     });
  // },
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