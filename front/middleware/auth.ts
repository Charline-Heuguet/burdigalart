// middleware/auth.js
export default defineNuxtRouteMiddleware((to, from) => {
  const authStore = useAuthStore();
  if (!authStore.user) {
    authStore.fetchUserFromToken();
  }
});


// // middleware/auth.ts
// import { defineNuxtRouteMiddleware, navigateTo } from 'nuxt/app'
// import { useAuthStore } from '~/stores/auth'

// export default defineNuxtRouteMiddleware((to, from) => {
//   const authStore = useAuthStore();
//   if (!authStore.isAuthenticated && to.path !== '/connexion') {
//     return navigateTo('/connexion');
//   }
// });
