<template>
  <div class="connexion">
    <div class="content">
      <h1>Connexion</h1>
      <form>
        <label for="signup-email" class="sr-only">Email</label>
        <input type="email" id="signup-email" placeholder="Email" v-model="credentials.email" required>

        <label for="signup-password" class="sr-only">Mot de passe</label>
        <input type="password" id="signup-password" name="signup-password" placeholder="Votre mot de passe"
          v-model="credentials.password">

        <button @click.prevent="login" type="submit">Se connecter</button>

        <p class="login-link">Vous n'avez pas de compte ?</p>
        <p>
          <NuxtLink to="/inscription">Inscrivez-vous</NuxtLink>
        </p>

      </form>
    </div>
  </div>
</template>

<!-- DERNIERE MODIF -->
<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { useAuthStore } from '~/stores/auth'; // Importer le store d'authentification

const credentials = ref({
  email: '',
  password: ''
});
const router = useRouter(); // Pour la redirection après la connexion réussie

const login = async () => {
  const response = await fetch('https://localhost:8000/api/users/login', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(credentials.value)
  });

  const data = await response.json();
  if (!response.ok) {
    alert(`Login failed: ${data.message}`);
    return;
  }


  const user = JSON.parse(atob(data.token.split('.')[1])); // Décoder la partie payload du JWT
  console.log(user); // Afficher les données de l'utilisateur pour vérifier

  const authStore = useAuthStore();
  authStore.setUser({
    email: user.email,
    roles: user.roles
  });

  localStorage.setItem('token', data.token); // Stocker le token dans le localStorage
  router.push('/profil'); // Rediriger l'utilisateur vers la page de profil ou dashboard
};
</script>

<style scoped lang="scss">
@import 'assets/base/colors';

h2 {
  text-align: center;
  margin-bottom: 20px;
}

.connexion {
  position: relative;
  padding: 20px;
  margin-top: 50px;
  overflow: hidden;
  background-color: $beigeclair;
  box-shadow: 0 0 30px 0 rgba(0, 0, 0, 0.3);
  border-radius: 10px;
  padding: 24px;
  margin: 50px 14px;
  overflow: hidden;
  max-width: 450px;
  margin: 30px auto;
}

.content {
  position: relative;
  z-index: 1;

  label,
  input,
  button {
    width: 100%;
    height: 2.5rem;
    display: block;
    margin-bottom: 20px;
    padding: 5px;
  }

  button {
    background-color: $mandarin;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  p {
    text-align: center;
  }
}
</style>