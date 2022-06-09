import { defineConfig } from 'vite'
import { svelte } from '@sveltejs/vite-plugin-svelte';
import { VitePWA } from 'vite-plugin-pwa';

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [svelte(), VitePWA({
    strategies: "injectManifest",
    mode: "development",
    base: "/",
    srcDir: "src",
    filename: "sw.ts",
    includeAssets: ['favicon.ico', 'robots.txt', 'icons/apple-touch-icon.png'],
    manifest: {
      "theme_color": "#f69435",
      "background_color": "#f69435",
      "display": "fullscreen",
      "scope": "/",
      "start_url": "/",
      "name": "Ankara Kendo Performance",
      "short_name": "AnkaraKendo",
      "description": "Ankara Kendo Board",
      "icons": [
        {
          "src": "/icons/icon-192x192.png",
          "sizes": "192x192",
          "type": "image/png",
          "purpose": "any maskable"
        },
        {
          "src": "/icons/icon-256x256.png",
          "sizes": "256x256",
          "type": "image/png",
          "purpose": "any maskable"
        },
        {
          "src": "/icons/icon-384x384.png",
          "sizes": "384x384",
          "type": "image/png",
          "purpose": "any maskable"
        },
        {
          "src": "/icons/icon-512x512.png",
          "sizes": "512x512",
          "type": "image/png",
          "purpose": "any maskable"
        }
      ]
    },
    devOptions: {
      enabled: true
      /* other options */
    }
  })]
})