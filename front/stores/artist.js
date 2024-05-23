// stores/artist.js
import { defineStore } from 'pinia';
import { useRuntimeConfig } from 'nuxt/app';

export const useArtistStore = defineStore('artist', {
  state: () => ({
    artist: null,
    loading: false,
    error: null,
  }),
  getters: {
    isLoaded: state => !!state.artist,
  },
  actions: {
    async fetchArtist(slug) {
      this.loading = true;
      const config = useRuntimeConfig();
      try {
        const response = await fetch(`${config.public.apiUrl}artists/${slug}`, {
          headers: { 'Authorization': `Bearer ${localStorage.getItem('token')}` },
        });
        if (!response.ok) throw new Error('Failed to fetch artist');
        this.artist = await response.json();
      } catch (err) {
        this.error = err.message;
        console.error('Fetch artist error:', this.error);
      } finally {
        this.loading = false;
      }
    },
    async updateArtist(slug, artistData) {
      this.loading = true;
      const config = useRuntimeConfig();
      try {
        const response = await fetch(`${config.public.apiUrl}artists/${slug}`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${localStorage.getItem('token')}`,
          },
          body: JSON.stringify(artistData),
        });
        if (!response.ok) throw new Error('Failed to update artist');
        this.artist = await response.json(); 
      } catch (err) {
        this.error = err.message;
        console.error('Update artist error:', this.error);
      } finally {
        this.loading = false;
      }
    }
  }
});
