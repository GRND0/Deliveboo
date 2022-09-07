<template>
  <main>
    <div class="container">
      <CustomSelettore @opzione="categoriaSelezionata($event)" />
      <div v-if="item.length > 0" class="row">
        <SingleRestaurantCard
          v-for="(item, index) in item"
          :key="index"
          :item="item"
          class="col-12 col-md-6"
        />
      </div>
      <h4 v-else class="text-center mt-5">
        Nessun ristorante corrisponde alle categorie selezionate
      </h4>
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
      restaurants: [],
      categoriaRistorante: [],
    };
  },

  created() {
      axios.get("/api/users").then((resp) => {
        this.item = resp.data.results;
        console.log("risposta axios lista ristoranti", this.item);
    
      }); 
  },      

  methods: {
    // questa funzione serve come toggle per le checkbox
    categoriaSelezionata(categoria) {
      this.categoriaRistorante = categoria;
      return this.categoriaRistorante;
    },

    comparatoreArray(array1, array2) {
      return array2.every((element) => array1.includes(element));
    },
  },

  computed: {
     ristorantiFiltrati() {
       axios.get(`/api/users/ricerca`, 
       {params: {id:this.categoriaRistorante}})
       .then(response => {
       this.item = response.data});
     },
  },
};
</script>

<style lang="scss" scoped>
</style>