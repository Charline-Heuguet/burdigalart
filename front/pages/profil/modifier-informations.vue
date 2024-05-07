<template>
    <div>
        <h2>Ici, modifiez vos informations</h2>
        <form @submit="submitForm">
            <div class="avatar">
                <img src="/img/icon-avatar.svg" alt="avatar">
                <input type="file" id="avatar" @change="onFileChange" accept="image/*">
                <label for="avatar">Avatar:</label>
            </div>
            <div>
                <label for="firstName">Prénom:</label>
                <input type="text" id="firstName" v-model="firstName">
            </div>
            <div>
                <label for="lastName">Nom de famille:</label>
                <input type="text" id="lastName" v-model="lastName">
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" v-model="email">
            </div>
            <div>
                <label for="password">Mot de passe:</label>
                <input type="password" id="password" v-model="password">
            </div>
            <div class="submit-form">
                <button type="submit">Sauvegarder</button>
            </div>
        </form>
    </div>
</template>

<script>
import { ref } from 'vue';

export default {
    setup() {
        const avatar = ref('');
        const firstName = ref('');
        const lastName = ref('');
        const email = ref('');
        const password = ref('');

        const submitForm = () => {
            // Handle form submission logic here
        };

        return {
            avatar,
            firstName,
            lastName,
            email,
            password,
            submitForm
        };
    }
};
</script>

<style lang="scss" scoped>
@import 'assets/base/colors';

form {
    max-width: 400px;
    margin: 0 auto;
}

.avatar {
    input {
        border: none;
        background-color: transparent;
    }
    label{
        visibility: hidden;
    }
}

img {
    width: 80px;
    height: auto;
    margin-right: 10px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input {
    width: 90%;
    margin: 10px;
    padding: 5px 5px 5px 10px;
    border: 1px solid black;
    border-radius: 10px;
    background-color: $beigeclair;
}

.submit-form{
    text-align: center;
    background-color: $mandarin;
    color: white;
    border: 1px solid $mandarin;
    border-radius: 30px;
    padding: 10px;
    margin: 20px auto;
    max-width: 150px;
}
</style>