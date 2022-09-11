<template>
    <div>
        <div class="container-fluid sfondo mb-4 my-pointer">
            <img class="w-100 rounded-pill img-j " src="../../../storage/uploads/shutterstock_1409325191.jpg" alt="">
            <h2 class="rounded-pill fw-bold my-pointer">Scarica la nostra App!</h2>
        </div>
    </div>
</template>

<script>
export default {
    name: "JumboTron",
};
</script>

<style lang="scss" scoped>
.sfondo {
  position: relative;
  h2 {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #00ccbc;
    padding: 1rem;
  }
}

.img-j {
  border: solid 2px transparent;
}

.img-j:hover {
  border: solid 2px #00ccbc;
  color: #00ccbc;
}
</style>