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
  color: #ffffff;
  background-color: #00ccbc;
}

label:hover {
  border: solid 2px #00ccbc;
  color: #00ccbc;
}

</style>