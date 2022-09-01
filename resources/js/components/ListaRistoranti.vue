<template>
  <main>
    <CustomSelettore @opzione="categoriaSelezionata($event)" />
    <div>
      <SingleRestaurantCard
        v-for="(item, index) in ristorantiFiltrati"
        :key="index"
        :item="item"
      />
    </div>
  </main>
</template>

  <script>
import SingleRestaurantCard from "./SingleRestaurantCard.vue";
import CustomSelettore from "./CustomSelettore.vue";
import axios from "axios";

export default {
  name: "ListaRistoranti",
  components: {
    SingleRestaurantCard,
    CustomSelettore,
  },

  data: function () {
    return {
      item: [],
      element: [],
      categoriaRistorante: "",
    };
  },

  created() {
    axios.get("/api/users").then((resp) => {
      this.item = resp.data;
      console.log("risposta axios lista ristoranti", this.item);
    //   console.log("risposta axios categorie", this.item[12].categories[1].id);
    });
  },

  methods: {
    categoriaSelezionata(categoria) {
      this.categoriaRistorante = categoria;
      console.log("categoria id", categoria);
    },
  },

  computed: {
    ristorantiFiltrati() {
      const results = [];

      this.item.forEach((element) => {
        element.categories.forEach((category) => {
            console.log( "id categorie prima di ciclo if=", category.id, "user id=", element.id);
          if ((category.id == this.categoriaRistorante)) {
             results.push(element.id);
          }
        });
      });
      console.log("result", results);
      return results;
    },

    // ristorantiFiltrati() {
    //     return this.item.filter((item) => {
    //          console.log("ristorantiFiltrati con categoria id", this.categoriaRistorante);

    //        return item.categories.includes(this.categoriaRistorante);
    //     });
    // }
  },
};
</script>

  <style scoped>
</style>