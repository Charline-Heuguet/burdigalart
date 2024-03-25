<template>
    <!-- Contenu de la page d'inscription -->
    <div class="back">
        <div class="content">
            <h2>Créez votre compte</h2>
            <form>
                <label for="username" class="sr-only">Nom</label>
                <input type="text" id="username" name="username" placeholder="Nom">

                <label for="firstname" class="sr-only">Prénom</label>
                <input type="text" id="firstname" name="firstname" placeholder="Prénom">

                <label for="signup-email" class="sr-only">Email</label>
                <input type="email" id="signup-email" name="signup-email" placeholder="Email">

                <label for="signup-password" class="sr-only">Mot de passe</label>
                <input type="password" id="signup-password" name="signup-password" placeholder="Votre mot de passe">

                <label type="password" id="signup-password-confirm" name="signup-password-confirm"
                    class="sr-only">Confirmez votre mot de passe</label>
                <input type="password" id="signup-password-confirm" name="signup-password-confirm"
                    placeholder="Confirmez votre mot de passe">

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

.back {
    background-color: #f7f1eb;
    position: relative;
    box-shadow: 0 0 30px 0 rgba(0, 0, 0, 0.3);
    border-radius: 10px;
    padding: 24px;
    margin: 50px 14px;
    overflow: hidden;
    z-index: 1;

    label, input, button {
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