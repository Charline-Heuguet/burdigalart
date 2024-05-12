<template>
    <!-- Contenu de la page d'inscription -->
    <div class="back">
        <div class="content">
            <h1>Créez votre compte</h1>
            <form>
                <label for="username" class="sr-only">Nom</label>
                <input type="text" id="username" name="username" placeholder="Nom" v-model="user.name">

                <label for="firstname" class="sr-only">Prénom</label>
                <input type="text" id="firstname" name="firstname" placeholder="Prénom" v-model="user.firstName">

                <label for="signup-email" class="sr-only">Email</label>
                <input type="email" id="signup-email" name="signup-email" placeholder="Email" v-model="user.email">

                <label for="signup-password" class="sr-only">Mot de passe</label>
                <input type="password" id="signup-password" name="signup-password" placeholder="Votre mot de passe"
                    v-model="user.password">

                <label type="password" id="signup-password-confirm" name="signup-password-confirm"
                    class="sr-only">Confirmez votre mot de passe</label>
                <input type="password" id="signup-password-confirm" name="signup-password-confirm"
                    placeholder="Confirmez votre mot de passe" v-model="user.passwordConfirm">

                <button @click.prevent="inscription" type="submit">Inscription</button>

                <p class="login-link">Vous avez déjà un compte ? </p>
                <p>
                    <NuxtLink to="/connexion">Connectez-vous</NuxtLink>
                </p>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();
const user = ref({
  name: '', 
  firstName: '', 
  email: '',
  password: '',
  passwordConfirm: ''
});

const inscription = async () => {
  if (user.value.password !== user.value.passwordConfirm) {
    alert('Les mots de passe ne correspondent pas.');
    return;
  }

  try {
    const response = await fetch('https://localhost:8000/api/users/signup', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        name: user.value.name,
        firstName: user.value.firstName,
        email: user.value.email,
        password: user.value.password,
      }),
    });

    if (!response.ok) {
      throw new Error('Échec de l’inscription');
    }

    alert('Inscription réussie!');
    router.push('/connexion');
  } catch (error) {
    alert(`Erreur: ${error.message}`);
  }
};
</script>


<style scoped lang="scss">
@import 'assets/base/colors';

h2 {
    text-align: center;
    margin-bottom: 20px;
}

.back {
    background-color: $beigeclair;
    position: relative;
    box-shadow: 0 0 30px 0 rgba(0, 0, 0, 0.3);
    border-radius: 10px;
    padding: 24px;
    margin: 50px 14px;
    overflow: hidden;
    z-index: 1;
    max-width: 450px;
    margin: 30px auto;

    label,
    input,
    button {
        width: 100%;
        height: 2.5rem;
        display: block;
        margin-bottom: 20px;
        padding: 8px 16px;
        font-size: 16px;
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