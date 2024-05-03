// Store pour le panier
import { defineStore } from 'pinia';

export const useCartStore = defineStore('cart', {
  state: () => ({
    items: []
  }),
  actions: {
    addItem(item) {
      const existingItem = this.items.find(i => i.id === item.id);
      if (existingItem) {
        existingItem.quantity += 1;
      } else {
        this.items.push({ ...item, quantity: 1 });
      }
    },
    removeItem(id) {
      this.items = this.items.filter(item => item.id !== id);
    },
    increment(id) {
      const item = this.items.find(i => i.id === id);
      if (item) {
        item.quantity++;
      }
    },
    decrement(id) {
      const item = this.items.find(i => i.id === id);
      if (item && item.quantity > 1) {
        item.quantity--;
      }
    },
    calculateItemTotal(item) {
      return item.quantity * item.price;
    },
    calculateTotal() {
      return this.items.reduce((total, item) => total + item.price * item.quantity, 0);
    }
  }
});
