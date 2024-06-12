// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  devtools: { 
    enabled: true 
  },
  // router: {
  //   middleware: ['auth']
  // },
  modules: [
    '@nuxtjs/tailwindcss',
    '@pinia/nuxt',
    '@pinia-plugin-persistedstate/nuxt',
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
