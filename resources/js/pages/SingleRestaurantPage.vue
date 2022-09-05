<template>
  <div class="container mb-2">
    <div class="row">
      <section v-if="user">
        <div class="row col-12 col-md-9 float-start">
          <h1 class="mt-4">{{ user.restaurant_name }}</h1>
          <h5>Categorie: <span v-for="category in user.categories" :key="category.slug">
              <div class="text-capitalize badge rounded-pill bg-success me-2 d-inline-block">{{ category.name }} </div>
            </span>
          </h5>
          <div v-if="user.image">
            <img class="rest-img" :src="user.image" :alt="user.restaurant_name"/>
          </div>
          <h5 class="text-secondary">Tel: {{ user.restaurant_phone }}</h5>
          <h6 class="text-success">{{ user.address }}</h6>
          <div><a href="">{{ user.link_social_media }}</a></div>
          
          <!-- piatti del ristorante -->
          <div class="col-12 col-lg-6" 
               v-for="dish in user.dishes" 
               :key="dish.slug"
               :class="dish.available == 0 ? 'not-visible' : ''"
               @click="[dish.available == 1 ? addToCart(dish) : '']"
              >
            <div class="card mt-3 my-pointer">
              <img class="card-img-top" :src="dish.image" :alt="dish.name">
              <div class="card-body d-flex justify-content-between">
                <h4 class="card-title text-capitalize">{{ dish.name }}</h4>
                <h4 class="text-success me-3">€ {{ dish.price }}</h4>
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item"> <span class="text-danger">Descrizione: </span>{{ capitalizeFirstLetter(dish.description) }}</li>
              </ul>
              <div class="card-body">
                <p class="card-text font-weight-bold text-capitalize"><span class="text-danger">Ingredienti: </span>{{ dish.ingredients }}</p>
              </div>
            </div>
          </div>   
        </div>

        <!-- Carrello -->
        <div class="col-12 col-md-3 float-end">
          <h2 class="mt-4">Carrello <i class="fa-solid fa-cart-arrow-down"></i></h2>
            <div class="mb-4" v-if="cart.length > 0">
              <div class="mb-1 d-flex justify-content-between" v-for="(dish, index) in cart" :key="index">
                <div class="mb-1 d-flex justify-content-between">
                  <div class="float-start">{{ dish.name }}</div>
                  <div class="float-end">€ {{ dish.price }}</div>
                </div>
                <button
                    class="btn btn-sm btn-danger"
                    @click="removeFromCart(dish)">
                    Rimuovi
                </button>
              </div>
              <div class="bg-success text-light">Totale: <span>€ {{ totalTwoDecimals }}</span></div>
            </div>
        </div>

        <!-- Checkout -->
        <div class="col-12 col-md-3 float-end" v-if="cart.length > 0">
          <h3 class="mt-4">Checkout</h3>
          <input
              class="form-control mb-2"
              type="text"
              v-model="customerName"
              placeholder="Nome*"
              required
          />
          <input
              class="form-control mb-2"
              type="text"
              v-model="customerSurname"
              placeholder="Cognome*"
              required
          />
          <input
              class="form-control mb-2"
              type="text"
              v-model="customerAddress"
              placeholder="Indirizzo*"
              required
          />
          <input
              class="form-control mb-2"
              type="text"
              v-model="customerPhone"
              placeholder="Numero di telefono*"
              @keyup="validatePhone(customerPhone)"
              required
          />
          <small class="text-danger"
                 v-if="validatePhoneMessage == 'Numero non valido'">
            {{ validatePhoneMessage }}
          </small>
          <input
              class="form-control mb-2"
              type="text"
              v-model="customerEmail"
              placeholder="Email*"
              required
              @keyup="validateEmail(customerEmail)"
          />
          <small class="text-danger"
                 v-if="validateEmailMessage == 'Email non valida'">
            {{ validateEmailMessage }}
          </small>
          <v-braintree
            authorization="registrarsi su braintree"
            locale="it_IT"
            btnText="Ordina"
            @success="onSuccess"
            @error="onError">
          </v-braintree>
        </div>

        <div v-if="responseMessage && cart.length == 0">
          <p class="text-success font-weight-bold">{{ responseMessage }}</p>
        </div>

      </section> 

      <section v-else><h2>Caricamento...</h2></section> 
    </div>
  </div>
</template>

<script>
export default {
  name: "SingleRestaurantPage",
  data() {
    return {
      user: null,
      cart: [],
      total: 0,
      dishIdsArray: [],
      // per checkout con braintree
      id: null,
      customerName: null,
      customerSurname: null,
      customerAddress: null,
      customerPhone: null,
      validatePhoneMessage: null,
      customerEmail: null,
      validateEmailMessage: null,
      responseMessage: null,
    }
  },

  created() {
    this.getDetails();
  },

  mounted() {
    const url = window.location.href;
    const id = url.substring(url.lastIndexOf("/") + 1);
    this.id = id;

    // evita di mettere nel carrello piatti di ristoranti differenti
    if (localStorage.getItem("id") && localStorage.getItem("id") != this.id) {
      console.log(this.id);
      console.log(localStorage.getItem("id"));
      localStorage.removeItem("cart");
      localStorage.removeItem("total");
      localStorage.removeItem("id");
    }

    if (localStorage.getItem("cart")) {
      try {
        this.cart = JSON.parse(localStorage.getItem("cart"));
        this.total = parseFloat(localStorage.getItem("total"));
        this.id = JSON.parse(localStorage.getItem("id"));
      } catch (e) {
        localStorage.removeItem("cart");
        localStorage.removeItem("total");
        localStorage.removeItem("id");
      }
    }
  },

  computed: {
    totalTwoDecimals() {
      return this.total.toFixed(2);
    },
  },

  methods: {
    capitalizeFirstLetter(string) {
      return string.charAt(0).toUpperCase() + string.slice(1);
    },
    addToCart(dish) {
      this.cart.push(dish);
      this.dishIdsArray.push(dish.id);
      this.total += parseFloat(dish.price);
      this.save();
    },

    removeFromCart(dish) {
      this.cart.splice(this.cart.indexOf(dish), 1);
      this.total -= parseFloat(dish.price);
      this.save();
    },

    save() {
      localStorage.setItem("cart", JSON.stringify(this.cart));
      localStorage.setItem("total", this.total);
      localStorage.setItem("id", this.id);
    },

    
    onSuccess(payload) {
      axios
        .post("/checkout", {
            nonce: payload.nonce,
            total: this.total.toFixed(2),
            restaurantId: this.id,
            customerName: this.customerName,
            customerSurname: this.customerSurname,
            customerAddress: this.customerAddress,
            customerPhome: this.customerPhome,
            customerEmail: this.customerEmail,
            dishIdsArray: this.dishIdsArray,
        })
        .then((response) => {
            this.cart = [];
            this.total = 0;
            this.save();
            this.responseMessage = response.data.message;
        });
    },

    onError(error) {
        let message = error.message;
    },

    validateEmail(value) {
      if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(value)) {
        this.validateEmailMessage = "Email valida";
      } else {
        this.validateEmailMessage = "Email non valida";
      }
    },

    validatePhone(value) {
      if (/^((\+|00)?39)?3\d{2}\d{6,7}$/.test(value)) {
        this.validatePhoneMessage = "Numero valido";
      } else {
        this.validatePhoneMessage = "Numero non valido";
      }
    },

    // chiamata axios per indirizzare sulla route del piatto singolo 
    getDetails() {
      const slug = this.$route.params.slug;
      axios
        .get(`/api/users/${slug}`) //ricordare di mettere backtick
        .then((resp) => {
          if (resp.data.success) {
            this.user = resp.data.results;
          } else {
            this.$router.push({ name: "not-found" });
          }          
      })
    }
  }
}
</script>

<style lang="scss" scoped>
.rest-img {
  width: 50%;
}

.not-visible {
  opacity: 0.3;
  &:hover {
    transform: none;
    cursor: initial;
  }
}
</style>