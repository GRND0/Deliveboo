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
        <h4 v-else class="text-center">Nessun ristorante corrisponde alle categorie selezionate</h4>
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
    //  categoriaSelezionata(categoria) {
    //   console.log("check categoria da selettore" , categoria);
    //    if (this.categoriaRistorante.includes(categoria) && categoria) {
    //          this.categoriaRistorante.splice(categoria)
    //    } else {
    //      this.categoriaRistorante.push(categoria)
    //    };
    //    console.log("categoriaSelezionata", this.categoriaRistorante);
    //    return this.categoriaRistorante;     
    //  }, 

    // questa funzione serve come toggle per le checkbox
    categoriaSelezionata(categoria) {
      this.categoriaRistorante = categoria
      return this.categoriaRistorante;
    }
  },

  computed: {
    ristorantiFiltrati() {
      const results = [];
      let arrayInterno= [];
      
      this.item.forEach((restaurants) => {
        restaurants.categories.forEach((category) => {
          //console.log( "id categorie prima di ciclo if=", category.id, "user id=", restaurants.id, "categoriaRistorante dentro filtro", this.categoriaRistorante);
          arrayInterno.push(category.id)
          console.log("arraynonvuoto", arrayInterno);

           if ((category.id == this.categoriaRistorante)) {
            
             results.push(restaurants);
            
          }
        });
      });
      
      console.log("result", results);
      arrayInterno=[]
      console.log("arraysvuotato", arrayInterno);
      return results;
    },
  },
};
</script>

<style lang="scss" scoped>

</style>