// Store pour le panier
import { defineStore } from 'pinia';

export const useCartStore = defineStore('cart', {
  state: () => ({
    items: [],
  }),
  getters: {
    // Définir comme getter pour pouvoir l'utiliser comme une propriété réactive
    calculateTotal: (state) => {
      return state.items.reduce((total, item) => total + item.quantity * item.price, 0);
    }
  },
  actions: {
    addItem(item) {
      const existingItem = this.items.find(i => i.id === item.id);
      if (existingItem) {
        existingItem.quantity += 1;
      } else {
        this.items.push({ ...item, quantity: 1 });
      }
      this.saveCart();
    },
    removeItem(id) {
      this.items = this.items.filter(item => item.id !== id);
      this.saveCart();
    },
    increment(id) {
      const item = this.items.find(i => i.id === id);
      if (item) {
        item.quantity++;
        this.saveCart();
      }
    },
    decrement(id) {
      const item = this.items.find(i => i.id === id);
      if (item && item.quantity > 1) {
        item.quantity--;
        this.saveCart();
      } else if (item && item.quantity === 1) {
        this.removeItem(id); // Optionnel : supprimer l'élément si quantité atteint zéro
      }
    },
    saveCart() {
      localStorage.setItem('cart', JSON.stringify(this.items));
    },
    loadCart() {
      const cart = localStorage.getItem('cart');
      if (cart) {
        this.items = JSON.parse(cart);
      }
    },
    init() {
      this.loadCart();
    }
  }
});

