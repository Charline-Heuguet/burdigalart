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
  ssr: false,
  plugins: [
    '~/plugins/cart.ts'
  ]
  // runtimeConfig: {
  //   public: {
  //     apiUrl: process.env.NUXT_API_URL || 'https://localhost:8000/api/',
  //   },
  // },
})
