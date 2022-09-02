import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import Home from "./pages/Home.vue";
import SingleRestaurantPage from "./pages/SingleRestaurantPage.vue"; // ricorda di riavviare npm run watch se non vedi niente
import About from "./pages/About.vue";
import NotFound from "./pages/NotFound.vue";
 
const router = new VueRouter({
  mode: "history",
  routes: [
    {
      path: "/",
      name: "home",
      component: Home
    },
    {
      path: "/users/:slug",
      name: "restaurant",
      component: SingleRestaurantPage
    },
    {
      path: "/about",
      name: "about",
      component: About
    },
    {
      path: "/*",
      name: "not-found",
      component: NotFound
    }
  ]
});
 
export default router;