// middleware/auth.ts
import { defineNuxtRouteMiddleware, navigateTo } from 'nuxt/app'
import { useUserStore } from '~/stores/user'

export default defineNuxtRouteMiddleware((to, from) => {
  const userStore = useUserStore();
  if (!userStore.isAuthenticated && to.path !== '/connexion') {
    return navigateTo('/connexion');
  }
})
