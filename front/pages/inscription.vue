<template>
    <div>
        <h2>Connexion</h2>
        <form @submit.prevent="login">
            <input type="email" v-model="email" placeholder="Email" required>
            <input type="password" v-model="password" placeholder="Mot de passe" required>
            <button type="submit">Se connecter</button>
        </form>
    </div>
</template>
  
<script setup>
const email = ref('');
const password = ref('');

function login() {
    // logique pour la connexion
    console.log('Connexion avec :', email.value, password.value);
}
</script>
  