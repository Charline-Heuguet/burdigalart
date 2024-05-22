// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  devtools: { 
    enabled: true 
  },
  modules: [
    '@nuxtjs/tailwindcss',
    '@pinia/nuxt',
  ],
  css: [
    '@/assets/main.scss'
  ],
  plugins: [
    '~/plugins/cart.ts'
  ],
  ssr: true,
  runtimeConfig: {
    apiUrl: 'http://localhost:8000/api/',
     public: {
       apiUrl: 'https://localhost:8000/api/',
     },
   },
})
