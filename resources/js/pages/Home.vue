<template>
<div class="container">
  <div class="bg"></div>
  <div class="bg bg2"></div>
  <div class="bg bg3"></div>
  <div class="row">
    <div class="col-12">
      <div class="container py-5">
        <h2 class="text-center fw-bold pb-3">Seleziona una o più categorie tra i ristoranti presenti nella tua zona!</h2>
        <div>
          <ListaRistoranti />
        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>
import ListaRistoranti from "../components/ListaRistoranti.vue";

export default {
  name: "Home",
  components: { ListaRistoranti },
};
</script>

<style lang="scss" scoped></style>