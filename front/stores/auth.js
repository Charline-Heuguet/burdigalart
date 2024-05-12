// store/auth.js
import { defineStore } from 'pinia';

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: null,
    roles: [] // champ pour les rôles
  }),
  getters: {
    isAuthenticated: (state) => !!state.user
  },
  actions: {
    setUser(userData) {
      this.user = userData;
      this.roles = userData.roles || []; // On suppose que `roles` est une propriété de `userData`
    },
    logout() {
      this.user = null;
      this.roles = [];
    }
  }
});
