<template>
    <div>
        <div>
            <label for="categories">Filtra per categoria</label>

            <select 
            name="categories" id="categories"
            v-model="category" @change="$emit('opzione', category)" >
                <option :value="category.id"
                    v-for="(category, index) in categories"
                    :key="index">
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
            categories: [],
            category: null,
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