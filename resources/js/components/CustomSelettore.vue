<template>
  <div class="row">
  <div v-for="category in categories" :key="category.id" class="col-12 col-md-6 col-lg-4 mb-3">
    <input
           type="checkbox"
           :id="category.slug"
           :value="category.id"
           v-model="checkbox"
           @change="$emit('opzione', checkbox)"
           />
    <label
           class="py-4 text-center d-block card"
           :for="category.slug"
           >
      {{ category.name }}
    </label>
  </div>
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

    // methods: { 
    //     async findByCheckbox() {
    //         if (this.checkbox.length == 0) {
    //             this.checkbox = [0].checked;
    //         }

    //         await axios
    //                 .get(`/api/categories` + this.checkbox)
    //                 .then((response)=> {
    //                     this.restaurants = response.data;
    //                     console.log("ristoranti",this.restaurants);
    //                 });

    //     }
    // },
};
</script>

<style lang="scss" scoped>

label {
  border: solid 2px #450063;
  color: #450063;
  font-weight: bold;
}

input[type=checkbox] {
  display: none;
}

input:checked + label {
  border: solid 2px #00ccbc;
  color: #00ccbc;
  background-color: #450063;
}

label:hover {
  border: solid 2px #00ccbc;
}

</style>