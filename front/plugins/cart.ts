// plugins/cart.ts
import { defineNuxtPlugin } from 'nuxt/app';
import { useCartStore } from '~/stores/useCartStore';

export default defineNuxtPlugin(nuxtApp => {
  if (process.client) { // ce code s'exécute uniquement côté client
    const cartStore = useCartStore();
    cartStore.init(); // Initialise le panier à partir de localStorage
  }
});
