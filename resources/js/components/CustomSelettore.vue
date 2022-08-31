<template>
    <div>
        <div>
            <label for="selettore-genere">Filtra per categoria</label>

            <select v-model="selezione" @change="$emit('opzione', selezione)" id="selettore-categoria">
                <option :value="category.id"
                    v-for="(category, index) in categories"
                    :key="index"
            >
              {{ category.name }}
            </option>
            </select>
        </div>


    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "CustomSelettore",
    data: function () {
        return {
            selezione: "",
        };
    },
    methods: {},

    created() {
    axios
      .get("/api/categories")
      .then((response)=> {
        this.categories = response.data;
      });
    },
};
</script>

<style>
</style>