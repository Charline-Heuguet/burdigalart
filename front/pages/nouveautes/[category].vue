<template>
  <div>
    <!-- <h1>Liste d'artistes de {{ category }}</h1>
    <div v-if="pending">Chargement des artistes...</div>
    <div v-else-if="error">Une erreur est survenue : {{ error }}</div>
    <ul v-else>
      <li v-for="artist in artists" :key="artist.id">{{ artist.name }}</li>
    </ul> -->
  </div>
</template>
  
<!-- <script setup lang="ts">
import { ref, computed } from 'vue';

const categoryId = 5; // ID de la catégorie pour Stand-Up

const { data, error, pending } = useFetch('http://localhost:8000/api/artists', {
  params: {
    category: categoryId,
  }
});

const artists = computed(() => data.value['hydra:member'] ?? []);
</script>
   -->