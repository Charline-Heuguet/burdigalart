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
      this.roles = userData.roles || [];
    },
    async fetchUserFromToken() {
      const runtimeConfig = useRuntimeConfig();
      const url = runtimeConfig.apiUrl || runtimeConfig.public?.apiUrl;
      const token = localStorage.getItem('token');
      if (token) {
        try {
          const userData = await $fetch(url + 'users', {
            headers: {
              'Authorization': `Bearer ${token}`
            }
          });
          this.setUser(userData);
        } catch (error) {
          console.error('Failed to fetch user data:', error);
          this.clearUserData();
        }
      }
    },
    async logout() {
      const runtimeConfig = useRuntimeConfig();
      const url = runtimeConfig.apiUrl || runtimeConfig.public?.apiUrl;
      const token = localStorage.getItem('token');

      if (!token) {
        console.error('Aucun token trouvé, impossible d\'envoyer la requête de déconnexion');
        this.clearUserData();
        return;
      }

      //console.log('Tentative de déconnexion avec le token:', token);

      try {
        await $fetch(`${url}users/logout`, {
          method: 'POST',
          headers: {
            'Authorization': `Bearer ${token}`
          }
        });
      } catch (error) {
        console.error('Logout failed:', error);
      } finally {
        this.clearUserData();
      }
    },
    clearUserData() {
      //console.log('Exécution du nettoyage');
      localStorage.removeItem('token'); // Suppression du JWT du localStorage
      this.user = null; // Réinitialisation de l'utilisateur
      this.roles = []; // Réinitialisation des rôles
      const router = useRouter();
      router.push('/'); // Redirection vers la page d'accueil
    }
  }
});
