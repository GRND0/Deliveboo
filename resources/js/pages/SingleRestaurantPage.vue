<template>
  <div class="container mb-2">
  <div class="bg"></div>
  <div class="bg bg2"></div>
  <div class="bg bg3"></div>
    <div class="row">
      <section v-if="user">
        <div class="row col-12 col-md-10 float-start">
          <div class="bg-light text-center rounded box-shadow">
          <h1 class="mt-4">{{ user.restaurant_name }}</h1>
          <h5>Categorie: <span v-for="category in user.categories" :key="category.slug">
            <div class="text-capitalize badge rounded-pill bg-success me-2 d-inline-block">{{ category.name }} </div>
            </span>
          </h5>
          <img class="restaurant-img" :src="user.image" :alt="user.restaurant_name"/>
          <h5 class="text-secondary mt-2"><i class="fa-solid fa-phone"></i> {{ user.restaurant_phone }}</h5>
          <h6 class="text-success"><i class="fa-solid fa-location-dot"></i> {{ user.address }}</h6>
          <div><a href=""><i class="fa-solid fa-at"></i> {{ user.link_social_media }}</a></div>
          </div>
          
          <!-- piatti del ristorante -->
          <div class="col-12 col-lg-6 position-relative card-group" 
               v-for="dish in dishes" 
               :key="dish.slug"
               :class="dish.available == 0 ? 'not-visible' : ''"
               @click="[dish.available == 1 ? addToCart(dish) : '']"
              >
            <div class="card mt-3 my-pointer ms-translate box-shadow">
              <div v-if="!dish.available">
                <div class="not-disp text-center text-uppercase">Piatto attualmente non disponibile</div>
                </div>
                <div v-if="dish.image">
                  <img class="d-none d-md-block card-img-top" :src="dish.image" :alt="dish.name">
                </div>
                <div v-else>
                  <img class="d-none d-md-block card-img-top" src="https://images.ctfassets.net/84wm3hhxw4gx/0sxerdVddcgpnd69VcMsx/414cb6a014fc90e5d96e07fef8022ccf/foodplaceholder.png" alt="placeholder">
                </div>
                <div class="card-body d-flex justify-content-between">
                  <h4 class="card-title text-capitalize">{{ dish.name }}</h4>
                  <h4 class="text-success me-3">€ {{ dish.price.toFixed(2) }}</h4>
                </div>
                <ul class="list-group list-group-flush d-none d-md-block">
                  <li class="list-group-item"> <span class="text-danger">Descrizione: </span>{{ capitalizeFirstLetter(dish.description) }}</li>
                </ul>
                <div class="card-body d-none d-md-block">
                  <p class="card-text font-weight-bold text-capitalize"><span class="text-danger">Ingredienti: </span>{{ dish.ingredients }}</p>
                </div>            
            </div>
          </div>   
        </div>

        <!-- Carrello -->
        <div class="col-12 col-md-3 col-lg-2 cart rounded-start">
          <h2 class="mt-2 text-center">Carrello <i class="fa-solid fa-cart-arrow-down"></i></h2>
          <div class="mb-4" v-if="cart.length > 0">
            <div class="mb-1 d-flex justify-content-between" v-for="(dish, index) in cart" :key="index">
              <div class="mb-1 d-flex justify-content-between cart-item">
                <div class="">{{ dish.name }}</div>
                <div class="pe-4">
                  <!-- <span class="">
                    <button type="button" class="btn btn-primary btn-sm" @click="removeProduct(dish)">-</button> 
                    {{ dish.quantity }} 
                    <button type="button" class="btn btn-primary btn-sm me-2" @click="addProduct(dish)">+</button> 
                  </span> -->
                  € {{(dish.price).toFixed(2) }}
                </div>
              </div>
              <button
                  class="btn btn-sm btn-danger text-light"
                  @click.prevent="removeFromCart(dish)">
                  Rimuovi
              </button>
            </div>
            <h4 class="bg-dark text-light text-center rounded p-1">Totale: <span>€ {{ total.toFixed(2) }}</span></h4>
          </div>

          <!-- Checkout -->
          <div v-if="cart.length > 0"> <!-- il checkout compare solo se c'è qualcosa nel carrello -->
            <h2 class="mt-2 text-center">Checkout <i class="fa-regular fa-credit-card"></i></h2>
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
            <div class="v-braintree"
              authorization="key da mettere"
              locale="it_IT"
              btnText="Ordina"
              @success="onSuccess"
              @error="onError">
            </div>
          </div>

          <div v-if="responseMessage && cart.length == 0">
            <p class="text-success font-weight-bold">{{ responseMessage }}</p>
          </div>
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
      quantity: 1,
      dishIdsArray: [],
      id: null,
      // per checkout con braintree
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
    this.id = id; // nel nostro caso l'id è uno slug e rappresenza il ristorante

    // evita di mettere nel carrello piatti di ristoranti differenti
    if (localStorage.getItem("id") && localStorage.getItem("id") != this.id) {
      console.log("ristorante dove si stavano aggiungendo oggetti nel carrello", localStorage.getItem("id"));
      console.log("nuovo ristorante dove non si può visualizzare il carrello precedente", this.id);
      if (confirm("Vuoi visualizzare un altro ristorante? Così perderai il tuo carrello")) {
        localStorage.removeItem("cart");
        localStorage.removeItem("total");
        localStorage.removeItem("id");          
      } else {
        history.back();   
        this.cart = JSON.parse(localStorage.getItem("cart"));
        this.total = parseFloat(localStorage.getItem("total"));
        this.id = JSON.parse(localStorage.getItem("id"));          
      }
    }
    // i dati del carrello rimangono salvati anche se si ricarica la pagina
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

  methods: {
    capitalizeFirstLetter(string) {
      return string.charAt(0).toUpperCase() + string.slice(1);
    },

    addToCart(dish) {
      // for (const products in this.cart) {

      //   let cartId = this.cart[products].id;

      //   // Confronto l'id del prodotto con  gli id già presenti nel carrello
      //   if (dish.id == cartId) {
      //     this.addProduct(this.cart[products]); // Se il piatto è già stato inserito, aggiunge solo la quantità
      //     break;  // break per uscire dal ciclo, perchè gli id combaciano
      //   }
      // }
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
          console.log(resp.data.results.dishes);
          if (resp.data.success) {
            this.user = resp.data.results.user;
            this.dishes = resp.data.results.dishes;
          } else {
            this.$router.push({ name: "not-found" });
          }          
      })
    },

    // metodo per aggiungere un item
    // addProduct(dish) {
    //   ++dish.quantity;
    //   console.log(dish.quantity);
    //   this.dishIdsArray.push();
    //   this.save();
    // },
    // removeProduct(dish) {
    //   if (dish.quantity < 0) {
    //     --dish.quantity;
    //     console.log(dish.quantity);
    //     this.dishIdsArray.push();
    //     this.save();
        
    //   }
    // },
  }
}
</script>

<style lang="scss" scoped>
.restaurant-img {
  width: 50%;
}

.not-visible {
  opacity: 0.5;
  &:hover {
    transform: none;
    cursor: default;
  }
}
  .not-disp {
    width: 100%;
    color: white;
    font-weight: bolder;
    opacity: 1;
    background-color: black;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 5;
  }

.cart {
  position: fixed;
  right: 0;
  padding: 5px;
  top: 10vh;
  background-color: #00ccbcaa;
  box-shadow: -2px 2px 10px -2px #00887d;

  .cart-item {
    width: 100%;
  }
}

// .checkout {
//   top: 10vh;
//   background-color: #00ccbcaa;
//   box-shadow: -2px 2px 10px -2px #00887d;
// }

@media screen and (max-width: 768px) {
  .cart {
    width: 100%;
    margin-top: 50vh;
    display: block;
    position: fixed;
    bottom: 0;
    left: 0;
    background-color: #00ccbc;
    box-shadow: 0px 0px 0px 0px;
  }
}
</style>