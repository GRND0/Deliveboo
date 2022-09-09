<template>
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <img class="img-logo" src="storage/uploads/logo-deliveboo.png" alt="logo">
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse bg-dark" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item"
              v-for="(link, index) in menuLinks"
              :key="index"
            >
              <router-link class="nav-link" :to="{name: link.name }">
                {{ link.title }}
              </router-link>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/login">Login</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
</template>

<script>
export default {
  name: "Header",
  data() {
    return {
      menuLinks: [
        {
          name: "home",
          title: "Home"
        },
        {
          name: "about",
          title: "Chi Siamo"
        },
      ]
    }
  }
};
</script>

<style>
</style>