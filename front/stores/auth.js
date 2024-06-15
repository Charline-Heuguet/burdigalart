// store/auth.js
import { defineStore } from 'pinia';

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: null,
    //roles: JSON.parse(localStorage.getItem('roles')) || []  // cahrgement des rôles depuis le localStorage
  }),
  getters: {
    isAuthenticated: (state) => !!state.user,
  },
  actions: {
    setUser(userData) {
      this.user = userData;
      this.roles = userData.roles || [];
      //localStorage.setItem('roles', JSON.stringify(this.roles));
    },

    
    // Fonction pour récupérer les données de l'utilisateur à partir du token
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
          localStorage.setItem('roles', JSON.stringify(userData.roles || []));
        } catch (error) {
          console.error('Failed to fetch user data:', error);
          this.clearUserData();
        }
      }
    },
    // Fonction pour se déconnecter
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
      const router = useRouter();
      router.push('/'); // Redirection vers la page d'accueil
    },

    async deleteUser(userId) {
      const runtimeConfig = useRuntimeConfig();
      const url = runtimeConfig.apiUrl || runtimeConfig.public?.apiUrl;
      try {
        const response = await $fetch(`${url}users/${userId}`, {
          method: 'DELETE'
        });
        console.log('Message du serveur:', response.message); // Affiche le message de succès
        this.clearUserData();
      } catch (error) {
        console.error('Failed to delete user:', error.message || 'No error message from server');
        throw error; // Pour la gestion d'erreur dans le composant
      }
    }
    

  }
});
