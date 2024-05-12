// middleware/auth.ts
import { defineNuxtRouteMiddleware, navigateTo } from 'nuxt/app'
import { useAuthStore } from '~/stores/auth'

export default defineNuxtRouteMiddleware((to, from) => {
  const authStore = useAuthStore();
  if (!authStore.isAuthenticated && to.path !== '/connexion') {
    return navigateTo('/connexion');
  }
});
