<template>
  <div class="back">
    <div class="content">
      <h1>Créez votre compte</h1>
      <form @submit.prevent="inscription">
        <label for="username" class="sr-only">Nom</label>
        <input type="text" id="username" name="username" placeholder="Nom" v-model="user.name">

        <label for="firstname" class="sr-only">Prénom</label>
        <input type="text" id="firstname" name="firstname" placeholder="Prénom" v-model="user.firstName">

        <label for="signup-email" class="sr-only">Email</label>
        <input type="email" id="signup-email" name="signup-email" placeholder="Email" v-model="user.email">

        <label for="signup-password" class="sr-only">Mot de passe</label>
        <input type="password" id="signup-password" name="signup-password" placeholder="Votre mot de passe"
          v-model="user.password">
          
          <label for="signup-password-confirm" class="sr-only">Confirmez votre mot de passe</label>
          <input type="password" id="signup-password-confirm" name="signup-password-confirm"
          placeholder="Confirmez votre mot de passe" v-model="user.passwordConfirm">
          <div class="error-message" v-if="errorMessage">{{ errorMessage }}</div>
          <!-- Section pour choisir les rôles supplémentaires -->
          <p>Si vous êtes un artiste ou un gérant de scène, cochez la case correspondante.</p>
          <div class="add-roles">
            <div>
              <label>Artiste</label>
              <input type="checkbox" v-model="additionalRoles" value="ROLE_ARTISTE">
            </div>
            <div>
              <label>Gérant de scène</label>
              <input type="checkbox" v-model="additionalRoles" value="ROLE_SCENE">
            </div>
          </div>
          
        
        <button type="submit">Inscription</button>

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

const errorMessage = ref(''); // Message d'erreur à afficher pour le mpd
const additionalRoles = ref([]); // Rôles supplémentaires à ajouter

// mot de passe fort 
const validatePassword = (password) => {
  const strongPasswordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
  return strongPasswordRegex.test(password);
};

const inscription = async () => {
  errorMessage.value = ''; // Réinitialiser le message d'erreur

  if (user.value.password !== user.value.passwordConfirm) {
    errorMessage.value = 'Les mots de passe ne correspondent pas.';
    return;
  }

  
  if (!validatePassword(user.value.password)) {
    errorMessage.value = 'Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.'
    return;
  }

  // Préparer les données à envoyer
  const userData = {
    name: user.value.name,
    firstName: user.value.firstName,
    email: user.value.email,
    password: user.value.password,
    roles: ['ROLE_USER', ...additionalRoles.value] // Toujours inclure ROLE_USER
  };

  // Afficher les données dans la console pour vérification
  // console.log("Données envoyées au backend:", JSON.stringify(userData));
  const runtimeConfig = useRuntimeConfig();
  const url = runtimeConfig.apiUrl || runtimeConfig.public?.apiUrl;

  try {
    const response = await fetch(url + 'users/signup', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(userData)
    });

    if (!response.ok) {
      const errorData = await response.json();
      alert(`Échec de l’inscription: ${errorData.message}`);
      return;
    }

    alert('Inscription réussie! Maintenant connectez-vous avec votre compte.');
    router.push('/connexion');
  } catch (error) {
    alert(`Erreur lors de l'inscription: ${error.message}`);
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
    height: 2.5em;
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

  .add-roles {
    margin-top: 20px;
    div {
      display: flex;
      justify-content: space-between;
      max-width: 200px;
    }


    input {
      width: auto;
    }

  }

  .error-message{
    color: red;
    font-size: 0.8em;
    margin-bottom:20px;
  };
}
</style>