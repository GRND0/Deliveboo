<template>
<div class="container">  
  <h1 class="mt-2 mb-2 text-center text-light bg-success rounded">Pagamento andato a buon fine! un nostro corriere sarà presto da te</h1>
  <div class="row">
    <img class="mb-2" src="https://www.orientativamente.it/wp-content/uploads/2021/04/food-delivery-5217579_1280-e1617726226397.png" alt="">

    <!-- dati del cliente -->
    <!-- <div class="form-container col-12 col-md-6 g-3 justify-content-around">
      <form>
        <div class="form-group row">
          <h2>Dati del cliente <i class="fa-solid fa-address-card"></i></h2>
          <div class="col-12 col-md-4">
            <input required class="form-control mb-2" type="text" name="name" placeholder="Nome">
          </div>
          <div class="col-12 col-md-4">
            <input required class="form-control mb-2"  type="text" name="lastname" placeholder="Cognome">
          </div>
          <div class="col-12 col-md-4">
            <input required class="form-control mb-2"  type="email" name="email" placeholder="Email">
          </div>
          <div class="col-12 col-md-6">
            <input required class="form-control mb-2"  type="text" name="address" placeholder="Indirizzo">
          </div>
          <div class="col-12 col-md-6">
            <input required class="form-control mb-2"  type="text" name="phone" placeholder="Cellulare (0039...)">
          </div>
        </div>

        <div class="pay-card mt-2">
          <h2>Dati della carta &#128179;</h2>

          <div class="row px-3 py-1">
            <div class="col-12 col-md-6 form-group">
              <label>Nome sulla carta</label>
              <input required class="form-control" size="4" type="text">
            </div>
            <div class="col-12 col-md-6 form-group">
              <label>Numero di carta</label>
              <input required autocomplete="off" class="form-control" size="20" type="text" name="card_no" value="1234 5678 0987 0000">
            </div>
          </div>

          <div class="row px-3 py-1">
            <div class="col-12 col-md-4 form-group">
              <label>CVV</label>
              <input required autocomplete="off" class="form-control" placeholder="123" size="3" type="text" name="cvv">
            </div>
            <div class="col-12 col-md-4 form-group">
              <label>Mese</label>
              <input required class="form-control" placeholder="MM" size="2" type="text" name="expiry_month">
            </div>
            <div class="col-12 col-md-4 form-group">
              <label>Anno</label>
              <input required class="form-control" placeholder="YYYY" size="4" type="text" name="expiry_year">
            </div>
          </div>

          <div class="row">
            <div class="col-12 form-group">
              <label>Prezzo totale</label>
              <input required class="form-control" size="2" type="number" name="total_price" value="totalPrice">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="form-group fw-bold">
            <button class="form-control btn btn-success fw-bold submit-button mt-2" type="submit">Procedi al pagamento <i class="fa-solid fa-money-bill-transfer"></i></button>
          </div>
        </div>
      </form>
    </div> -->

    <!-- carrello -->
    <!-- <div class="col-12 col-md-4">
      <h2>Carrello <i class="fa-solid fa-cart-shopping"></i></h2>

      <div class="d-flex justify-content-between">
        <div>
          dish.quantity
        </div>

        <div>
          X
        </div>

        <div>
          dish.name
        </div>

        <div>
          <span>€ dish.price</span>
        </div>
      </div>

      <h3 class="bg-dark text-success rounded p-2">
        Totale: € totalPrice
      </h3>    
    </div> -->
  </div>

</div>
</template>

<script>
import SingleRestaurantPage from "./SingleRestaurantPage.vue";
export default {
  name: "Checkout",
  components: {
    SingleRestaurantPage
  },
  mounted() {
    this.getCart();
  },
  data() {
    return {
      products: [],
    };
  },
  methods: {
    getCart() {
      const cart = JSON.parse(localStorage.cart);
      this.products = cart;
    },
    getAmount() {
      let amount = 0;
      this.products.forEach((element) => {
        amount += element.price * element.productQuantity;
      });
      amount = parseFloat(amount.toFixed(2));
      return amount;
    }
  },
};
</script>

<style lang="scss" scoped>
</style>