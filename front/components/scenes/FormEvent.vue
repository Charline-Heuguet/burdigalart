<template>
    <form @submit.prevent="submitForm">
      <input v-model="scene.name" type="text" placeholder="Nom de l'événement" required />
      <input v-model="scene.address" type="text" placeholder="Adresse" required />
      <input v-model="scene.zipcode" type="number" placeholder="Code Postal" required />
      <input v-model="scene.town" type="text" placeholder="Ville" required />
      <button type="submit">Créer l'événement</button>
    </form>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  
  const scene = ref({
    name: '',
    address: '',
    zipcode: '',
    town: '',
  });
  
  const submitForm = async () => {
    try {
      const response = await useFetch('/api/scenes', {
        method: 'POST',
        body: scene.value,
      });
      console.log('Événement créé :', response.data.value);
    } catch (error) {
      console.error('Erreur lors de la création de l\'événement:', error);
      // Gérer l'erreur, par exemple en affichant un message d'erreur
    }
  };
  </script>
  