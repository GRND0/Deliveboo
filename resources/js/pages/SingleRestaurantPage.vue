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

        
        <div class="col-12 col-md-3 col-lg-2 cart rounded-start">
          <h2 class="mt-2 text-center">Carrello <i class="fa-solid fa-cart-arrow-down"></i></h2>
          <!-- Carrello -->
          <div class="mb-3" v-if="cart.length > 0">
            <div v-for="dish, i in cart" class="mb-1 d-flex justify-content-between" :key="i">
              <div class="mb-1 d-flex justify-content-between cart-item">
                <div>{{ dish.name }}</div>

                <div class="pe-4">
                  <span class="">
                      <button type="button" class="btn btn-primary btn-sm" @click="removeProduct(dish)">-</button> 
                      {{ dish.quantity }} 
                      <button type="button" class="btn btn-primary btn-sm me-2" @click="addProduct(dish)">+</button> 
                  </span>
                  <span>€ {{ parseFloat(dish.price).toFixed(2) }}</span>
                </div>
              </div>

              <button
                  class="btn btn-sm btn-danger text-light"
                  @click.prevent="removeFromCart(i)">
                  Rimuovi
              </button>
                
            </div>
            <h4 class="bg-dark text-light text-center rounded p-1">Totale: <span>€ {{ totalPrice }}</span></h4>
          </div>

          <!-- Checkout -->
          <div class="form-container justify-content-around" v-if="cart.length > 0">
            <form>
              
              <div class="form-group row">
                <h2 class="text-center">Dati del cliente <i class="fa-solid fa-address-card"></i></h2>
                <div class="col-6 col-md-12">
                  <input required class="form-control mb-2" @input="verify()" @blur="verify()" @focus="verify()" id="name" type="text" name="name" placeholder="Nome">
                </div>
                <div class="col-6 col-md-12">
                  <input required class="form-control mb-2" @input="verify()" @blur="verify()" @focus="verify()" id="email" type="email" name="email" placeholder="Email">
                </div>
                <div class="col-6 col-md-12">
                  <input required class="form-control mb-2" @input="verify()" @blur="verify()" @focus="verify()" id="address" type="text" name="address" placeholder="Indirizzo">
                </div>
                <div class="col-6 col-md-12">
                  <input required class="form-control mb-2" @input="verify()" @blur="verify()" @focus="verify()" id="phone" type="text" name="phone" placeholder="Cellulare (0039...)" maxlength="10" minlength="10">
                </div>
              </div>

              <div class="pay-card mt-2">
                <h2 class="text-center">Dati della carta &#128179;</h2>

                <div class="row px-1">
                  <div class="col-6 col-md-12 form-group">
                    <label>Nome sulla carta</label>
                    <input required class="form-control" size="4" type="text" @input="verify()" @blur="verify()" @focus="verify()" id="card_name">
                  </div>
                  <div class="col-6 col-md-12 form-group">
                    <label>Numero di carta</label>
                    <input @input="verify()" @blur="verify()" @focus="verify()" required autocomplete="off" class="form-control" size="20" type="text" id="card_no" name="card_no" placeholder="1234 5678 0987 0000" maxlength="16" minlength="16">
                  </div>
                </div>

                <div class="row px-1">
                  <div class="col-4 form-group">
                    <label>CVV</label>
                    <input @input="verify()" @blur="verify()" @focus="verify()" required autocomplete="off" class="form-control" placeholder="123" size="3" type="text" id="cvv" name="cvv" maxlength="3" minlength="3">
                  </div>
                  <div class="col-4 form-group">
                    <label>Mese</label>
                    <input @input="verify()" @blur="verify()" @focus="verify()" required class="form-control" placeholder="MM" size="2" type="text" id="expiry_month" name="expiry_month" maxlength="2" minlength="2">
                  </div>
                  <div class="col-4 form-group">
                    <label>Anno</label>
                    <input @input="verify()" @blur="verify()" @focus="verify()" required class="form-control" placeholder="YYYY" size="4" type="text" id="expiry_year" name="expiry_year" maxlength="4" minlength="4">
                  </div>
                </div>

              </div>

              <div class="row mt-3">
                <div class="form-group fw-bold">
                  <button disabled="true" id="submit" type="submit" class="form-control btn btn-warning btn-lg"> 
                    <router-link to="/checkout">
                      Procedi al pagamento <i class="fa-regular fa-credit-card"></i>
                    </router-link>
                  </button>
                </div>
              </div>
            </form>
          </div>

          <!-- <div class="text-center" v-if="cart.length > 0">   -->
            <!-- il checkout compare solo se c'è qualcosa nel carrello -->
            <!-- <router-link to="/checkout">
              <button class="btn btn-light btn-lg"> 
               Procedi al pagamento <i class="fa-regular fa-credit-card"></i>
              </button>
            </router-link> -->

            <!-- <div class="v-braintree"
              authorization="key da mettere"
              locale="it_IT"
              btnText="Ordina"
              @success="onSuccess"
              @error="onError">
            </div>           -->

            <!-- <div v-if="responseMessage && cart.length == 0">
              <p class="text-success font-weight-bold">{{ responseMessage }}</p>
            </div> -->
          <!-- </div> -->
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
      id: null,
      // per checkout con braintree
      // customerName: null,
      // customerSurname: null,
      // customerAddress: null,
      // customerPhone: null,
      // validatePhoneMessage: null,
      // customerEmail: null,
      // validateEmailMessage: null,
      // responseMessage: null,
    }
  },

  created() {
    this.getDetails();
  },

  mounted() {
    const url = window.location.href;
    const id = url.substring(url.lastIndexOf("/") + 1);
    this.id = id; // nel nostro caso l'id è uno slug e rappresenza il ristorante

    // gestione carrello
    if (localStorage.getItem("id") && localStorage.getItem("id") != this.id) {
      console.log("ristorante dove si stavano aggiungendo oggetti nel carrello", localStorage.getItem("id"));
      console.log("nuovo ristorante dove non si può visualizzare il carrello precedente", this.id);
      if (confirm("Vuoi visualizzare un altro ristorante? Così perderai il tuo carrello")) {
        localStorage.removeItem("cart");
        localStorage.removeItem("id");          
      } else {
        history.back();   
        this.cart = JSON.parse(localStorage.getItem("cart"));
        this.id = JSON.parse(localStorage.getItem("id"));          
      }
    }
    // i dati del carrello rimangono salvati anche se si ricarica la pagina
    if (localStorage.getItem("cart")) {
      try {
        this.cart = JSON.parse(localStorage.getItem("cart"));
        this.id = JSON.parse(localStorage.getItem("id"));
      } catch (e) {
        localStorage.removeItem("cart");
        localStorage.removeItem("id");
      }
    }


    // gestione carrello
    // if (localStorage.getItem('cart')) {
    //   try {            
    //     this.cart = JSON.parse(localStorage.getItem('cart'));
    //     // finding ci serve per gestire un carrello per volta
    //     let finding = false;
    //     for (const dish in this.dishes) {
    //       for (let i = 0; i < this.cart.length; i++) {
    //           // se l'id dei piatti nel carrello e gli id dei piatti dell'array originale combaciano, 
    //           //ritorno il carrello presente nel localStorage
    //         if (this.cart[i].id == this.dishes[dish].id) {
    //           this.cart = JSON.parse(localStorage.getItem('cart'));
    //           finding = true; break;
    //         } else {
    //           finding = false;
    //         }
    //       }
    //       // Se finding è true, esco dal ciclo con il break
    //       if (finding) {
    //         break;
    //       } 
    //     }
        // se finding risulta false appare un confirm e se l'utente clicca ok eliminerà il carrello precedente 
        // mentre cancel ritornerà alla pagina dei ristoranti ma senza eliminare il carrello

        // evita di mettere nel carrello piatti di ristoranti differenti
        // if (finding == false) {
        //   if (confirm("Attenzione! Se passi ad un altro ristorante toglierai tutti i tuoi ordini dal carrello, vuoi continuare?")) {
        //     localStorage.removeItem('cart');
        //     this.cart = [];
        //   } else {
        //     this.cart = JSON.parse(localStorage.getItem("cart"));
        //     history.back(); // rimane sulla pagina corrente
        //   }
        // }

    //   } catch(e) {
    //     localStorage.removeItem('cart');
    //   }
    // }
  },

  computed: {
    // calcolo del prezzo totale carrello
    totalPrice() {          
      let total = 0;
      for (let i = 0; i < this.cart.length; i++) {          
        total = parseFloat(total) + parseFloat(this.cart[i].price); // somma tutti i totali dei vari (piatto x quantità)        
      }
      return total.toFixed(2);
    }
  },

  methods: {
    // chiamata axios per indirizzare sulla route del piatto singolo 
    getDetails() {
      const slug = this.$route.params.slug;
      axios
        .get(`/api/users/${slug}`) //ricordare di mettere backtick
        .then((resp) => {
          // console.log(resp.data.results.dishes);
          if (resp.data.success) {
            this.user = resp.data.results.user; // dati del ristorante
            this.dishes = resp.data.results.dishes; // dati dei piatti per visualizzare le immagini
          } else {
            this.$router.push({ name: "not-found" });
          }
        })
    },

    // mettere sempre la maiuscola iniziale
    capitalizeFirstLetter(string) {
      return string.charAt(0).toUpperCase() + string.slice(1);
    },

    // aggiungere un piatto nel carrello (clic sul piatto del menù)
    addToCart(dish) {
      dish['quantity'] = 1;
      let finding = true;
      for (const dishes in this.cart) {
        let id = this.cart[dishes].id;
        if (dish.id !== id) {
          finding = true;
        } else {
          this.addProduct(this.cart[dishes]); // se il piatto è già stato inserito, aggiunge solo la quantità
          finding = false; break;
        }
      }

      if(finding) {
        this.cart.push(dish); // push del piatto all'interno dell'array del carrello
        this.saveCart(); // per il davide del futuro, non cambiare l'ordine di queste funzioni!!!
        this.cart = JSON.parse(localStorage.getItem('cart'));
      }
    },

    // eliminare un piatto dal carrello (tasto rimuovi)
    removeFromCart(index) {
      this.cart.splice(index, 1);      
      if (this.cart.length == 0) {
        localStorage.removeItem('cart');
      } else {
        this.saveCart();
      }        
    },

    // gestione salvataggio dati in locale
    saveCart() {
      const parsed = JSON.stringify(this.cart);
      localStorage.setItem('cart', parsed);
      localStorage.setItem("id", this.id);
    },

    // aggiungere un piatto già presente nel carrello (tasto + | clic sul piatto del menù)
    addProduct(item) {
      for (const dish in this.dishes) {
        if (this.dishes.hasOwnProperty.call(this.dishes, dish)) {
          const dishOriginal = this.dishes[dish];
          if (item.id == dishOriginal.id) {
            item.quantity += 1;
            item.price = dishOriginal.price * item.quantity;
            this.saveCart();
          }
        }
      }
    },

    // sottrarre un piatto dal carrello (tasto -)
    removeProduct(item) {
      if (item.quantity > 1) {
        for (const dish in this.dishes) {
          if (this.dishes.hasOwnProperty.call(this.dishes, dish)) {

            const dishOriginal = this.dishes[dish];

            if (item.id == dishOriginal.id) {
              item.quantity -= 1;
              item.price = dishOriginal.price * item.quantity;
              this.saveCart();
            }
          }
        }
      // se la quantità è uguale a 1 e continuiamo a cliccare sul meno, rimuoviamo l'elemento dal carrello
      } else {
        if (confirm("Eliminare questo piatto dal carrello?")) {
          let index = this.getIndexById(item.id);
          this.removeFromCart(index);
        }
      }
    },

    // restituisce l'indice di un piatto nel carrello
    getIndexById(id) {
      for (let j = 0; j < this.cart.length; j++) {
        const cart = this.cart[j];
        if (cart.id == id) {
          return j;
        }
      }
      return -1;
    },

    verify() {
      // let itIsNumber = /^\d{4}$/.test(val);

      if (
          (document.getElementById('name').value.trim() != '')

          && (document.getElementById('email').value.trim() != '')

          && (document.getElementById('address').value.trim() != '')

          && ((document.getElementById('phone').value.trim() != '')
          && ((document.getElementById('phone').value.length) == 10)
          && !isNaN(document.getElementById('phone').value))

          && (document.getElementById('card_name').value.trim() != '')

          && ((document.getElementById('card_no').value.trim() != '') 
          && ((document.getElementById('card_no').value.length) == 16) 
          && !isNaN(document.getElementById('card_no').value))

          && ((document.getElementById('cvv').value.trim() != '') 
          && ((document.getElementById('cvv').value.length) == 3) 
          && !isNaN((document.getElementById('cvv').value)))

          && ((document.getElementById('expiry_month').value.trim() != '') 
          && ((document.getElementById('expiry_month').value) > 0) 
          && ((document.getElementById('expiry_month').value) <= 12))

          && ((document.getElementById('expiry_year').value.trim() != '') 
          && ((document.getElementById('expiry_year').value) > 2021))
          && ((document.getElementById('expiry_year').value) <= 2030))
      {
          document.getElementById('submit').disabled = false;
      } else {
          document.getElementById('submit').disabled = true;
      }
    },
 
    // onSuccess(payload) {
    //   axios
    //     .post("/checkout", {
    //       nonce: payload.nonce,
    //       total: this.total.toFixed(2),
    //       restaurantId: this.id,
    //       customerName: this.customerName,
    //       customerSurname: this.customerSurname,
    //       customerAddress: this.customerAddress,
    //       customerPhome: this.customerPhome,
    //       customerEmail: this.customerEmail,
    //       dishIdsArray: this.dishIdsArray,
    //     })
    //     .then((response) => {
    //       this.cart = [];
    //       this.total = 0;
    //       this.save();
    //       this.responseMessage = response.data.message;
    //     });
    // },

    // onError(error) {
    //   let message = error.message;
    // },

    // validateEmail(value) {
    //   if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(value)) {
    //     this.validateEmailMessage = "Email valida";
    //   } else {
    //     this.validateEmailMessage = "Email non valida";
    //   }
    // },

    // validatePhone(value) {
    //   if (/^((\+|00)?39)?3\d{2}\d{6,7}$/.test(value)) {
    //     this.validatePhoneMessage = "Numero valido";
    //   } else {
    //     this.validatePhoneMessage = "Numero non valido";
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
  top: 10vh;
  padding: 5px;
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
    margin-top: 55vh;
    display: block;
    position: fixed;
    bottom: 0;
    left: 0;
    background-color: #00ccbc;
    box-shadow: 0px 0px 0px 0px;
    overflow-y: auto;
  }
}
</style>