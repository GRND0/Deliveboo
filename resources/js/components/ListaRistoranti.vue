<template>
    <main>
        <CustomSelettore @opzione="categoriaSelezionata($event)" />
        <div>
            <SingleRestaurantCard v-for="(item,index) in ristorantiFiltrati" :key="index" :ristoranti="item" />
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
                ristoranti: [],
                categoria: "",
            };
        },

        created() {
            axios
            .get("/api/users")
            .then((resp) => {
                this.ristoranti = resp.data.restaurant_name
            }
             );

            
        },

        methods: {
            categoriaSelezionata(categoria) {
                this.categoriaRistorante = categoria;
            },
        },

        computed: {
            ristorantiFiltrati() {
                return this.ristoranti.filter((item) => {
                    return item.category.includes(this.categoriaRistorante);
                }
                );
            }
        }
    };
  </script>