<template>
    <main>
        <CustomSelettore @opzione="categoriaSelezionata($event)" />
        <div>
            <SingleRestaurantCard v-for="(item,index) in ristorantiFiltrati" :key="index" :item="item" />
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
                categoriaRistorante: "",
            };
        },

        created() {
            axios
            .get("/api/users")
            .then((resp) => {
                this.item = resp.data;
                console.log("risposta axios lista ristoranti", this.item);
            }
             );

            
        },

        methods: {
            categoriaSelezionata(categoria) {
                this.categoriaRistorante = categoria;
                console.log("categoria id", categoria);
            },
        },

        computed: {
            ristorantiFiltrati() {
                return this.item.filter((item) => {
                    item.category.includes(this.categoriaRistorante);
                    console.log("categoria filtrata", this.categoriaRistorante);
                });
            }
        }
    };
  </script>