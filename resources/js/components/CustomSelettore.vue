<template>
    <div class="container">
        <div class="row">
            <!-- <div>
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
            </div> -->

            <div v-for="(category, index) in categories"
                :key="index"
                class="col-6 mb-3">
                <div class="card">
                    <!-- <div class="card-head">
                        <img src="" :alt= category.name>
                    </div> -->
                    <div @click="$emit('opzione', category)" class="card-body my-pointer">
                        <div class="text-center">
                            {{ category.name }}
                        </div>
                    </div>
                </div>                
            </div>
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