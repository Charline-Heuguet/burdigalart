<template>
  <form @submit.prevent="submitForm">
    <div>
      <label for="firstName">Prénom:</label>
      <input id="firstName" v-model="user.firstName" type="text" required>
    </div>
    <div>
      <label for="lastName">Nom:</label>
      <input id="lastName" v-model="user.lastName" type="text" required>
    </div>
    <div>
      <label for="email">Email:</label>
      <input id="email" v-model="user.email" type="email" required>
    </div>
    <div>
      <label for="password">Mot de passe:</label>
      <input id="password" v-model="user.password" type="password" required>
    </div>
    <button type="submit">S'inscrire</button>
  </form>
</template>

<script setup lang="ts">
import { reactive } from 'vue';
import { useFetch } from 'nuxt/app';

const user = reactive({
  firstName: '',
  lastName: '',
  email: '',
  password: '',
});

const submitForm = async () => {
  console.log('User Data:', user);
  // appel API pour enregistrer l'utilisateur avec $fetch
  try {
    const response = await useFetch('http://localhost:8000/api/users', {
      method: 'POST',
      body: {
        firstName: user.firstName,
        lastName: user.lastName,
        email: user.email,
        password: user.password
      },
      headers: {
        'Content-Type': 'application/ld+json'
      }
    });
    console.log('Inscription réussie:', response.data);
  } catch (error) {
    // Ici tu peux gérer les erreurs, comme afficher un message d'erreur à l'utilisateur
    console.error('Il y a eu un problème avec l\'inscription:', error);
  }
};
</script>
