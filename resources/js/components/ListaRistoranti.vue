<template>
  <main>
    <div class="container">
      <CustomSelettore @opzione="categoriaSelezionata($event)" />
      <div v-if="ristorantiFiltrati.length > 0" class="row">
        <SingleRestaurantCard
          v-for="(item, index) in ristorantiFiltrati"
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
      //   console.log("risposta axios categorie", this.item[12].categories[1].id);
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
      

//        if (array1.length === array2.length) {
//     return array1.every(element => {
//        if (array2.includes(element)) {
//          return true;
//       }

//       return false;
//    });
//   }

//  return false;
 
  
}
}, 
  

  computed: {
    ristorantiFiltrati() {
      let results =[];

      this.item.forEach((restaurants) => {
        let arrayInterno = [];
        restaurants.categories.forEach((category) => {
          console.log( "id categorie prima di ciclo if=", category.id, "user id=", restaurants.id, );
          arrayInterno.push(category.id);
        });
        console.log("arraynonvuoto",  arrayInterno,"categoriaRistorante dentro filtro",  this.categoriaRistorante);
        if (this.comparatoreArray(arrayInterno,this.categoriaRistorante)) { 
          results.push(restaurants);
         
        }
       
        console.log("result interno", results);
      });

      console.log("result esterno", results);
      // arrayInterno=[]

      return results;
    },
  },
};
</script>

<style lang="scss" scoped>
</style>