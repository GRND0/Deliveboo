<template>
  <div class="row">
    <label
      v-for="category in categories"
      class="col-6 mb-3 py-2 d-flex flex-row justify-content-between align-items-center card"
      :key="category.id"
    >
      {{ category.name }}

      <input
        type="checkbox"
        :value="category.id"
        v-model="checkbox"
        @change="$emit('opzione', checkbox)"
      />
    </label>
  </div>

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

  <!-- <div v-for="(category, index) in categories"
                :key="index"
                class="col-6 mb-3">
                <div class="card">
                     <div @click="$emit('opzione', category.id)" class="card-body my-pointer">
                        <div class="text-center">
                            {{ category.name }} 
                        </div>
                    </div>
                    
                </div>                
            </div>
        </div> -->
</template>

<script>
import axios from "axios";


export default {
    name: "CustomSelettore",
    data: function () {
        return {
            restaurants: [],
            categories: [],
            category: [],
            checkbox: [],
            
        };
    },
   

  created() {
      axios
      .get("/api/categories")
      .then((response)=> {
        this.categories = response.data;
      });
    },

    methods: { 
        async findByCheckbox() {
            if (this.checkbox.length == 0) {
                this.checkbox = [0].checked;
            }

            await axios
                    .get(`/api/categories` + this.checkbox)
                    .then((response)=> {
                        this.restaurants = response.data;
                        console.log("ristoranti",this.restaurants);
                    });

        }
    },
};
</script>

<style scoped>
</style>