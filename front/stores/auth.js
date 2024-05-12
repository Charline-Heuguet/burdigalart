import { defineStore } from 'pinia';

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: null
  }),
  actions: {
    setUser(userData) {
      this.user = userData;
    },
    logout() {
      this.user = null;
    }
  }
});