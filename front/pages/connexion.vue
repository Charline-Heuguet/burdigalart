<template>
  <div class="connexion">
    <div class="content">
      <h2>Connexion</h2>
      <form @submit.prevent="login">
        <label for="signup-email" class="sr-only">Email</label>
        <input type="email" id="signup-email" placeholder="Email" v-model="email" required>

        <label for="signup-password" class="sr-only">Mot de passe</label>
        <input type="password" id="signup-password" name="signup-password" placeholder="Votre mot de passe"
          v-model="password">

        <button type="submit">Se connecter</button>

        <p class="login-link">Vous n'avez pas de compte ?</p>
        <p>
          <NuxtLink to="/inscription">Inscrivez-vous</NuxtLink>
        </p>

      </form>
    </div>
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