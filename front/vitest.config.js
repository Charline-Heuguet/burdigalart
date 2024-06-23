import { defineConfig } from 'vitest/config'
import vue from '@vitejs/plugin-vue'

export default defineConfig({
  plugins: [vue()],
  test: {
    globals: true,
    environment: 'jsdom'
  }
})
// Cette configuration permet à Vitest de reconnaître les fichiers .vue et utilise jsdom comme environnement de test.

