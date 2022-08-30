<template>
<div class="container">
  <div class="row">
    <div class="col-12">
      <div class="container py-5">
        <h2 class="text-center pb-3">I migliori ristoranti nella tua zona!</h2>
        <div>
          <a
            href=""
            class="d-flex"
            v-for="(user, index) in listRestaurants"
            :key="index"
          >
            <img :src="user.image" :alt="user.restaurant_name"/>
            <div class="p-4">                
              <h3 class="font-weight-bold">{{ user.restaurant_name }}</h3>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

</template>

<script>
import axios from "axios";

export default {
  name: "Home",
  components: {},
  data() {
    return {
      users: [],
    };
  },
  // mounted() {
  //   axios
  //        .get('/api/users/') // <-- problema con auth ? controllare route list
  //       .then((response) => {
  //         this.users = response.data;
  //         console.log(this.users);
  //       })
  //       .catch((error) => {
  //         console.log(error);
  //       });
  // },
  // computed: {
  //     listRestaurants() {
  //       return this.users;
  //     },
  // },
};
</script>

<style lang="scss" scoped>
img {
  width: 30%;
  height: 15vh;
  object-fit: cover;
}
</style>