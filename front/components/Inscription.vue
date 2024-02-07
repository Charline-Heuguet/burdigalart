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
  
  <script setup>
  import { reactive } from 'vue';
  
  const user = reactive({
    firstName: '',
    lastName: '',
    email: '',
    password: '',
  });
  
  const submitForm = () => {
    console.log('User Data:', user);
    // Ici, tu ferais ton appel API pour enregistrer l'utilisateur
    // Exemple:
    // axios.post('ton_endpoint_api/utilisateurs', user)
    //   .then(response => {
    //     // Traiter la réponse
    //   })
    //   .catch(error => {
    //     // Gérer l'erreur
    //   });
  };
  </script>
  