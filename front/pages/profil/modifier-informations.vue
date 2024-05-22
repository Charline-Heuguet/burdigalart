<template>
    <div>
        <h2>Ici, modifiez vos informations</h2>
        <form @submit.prevent="submitForm">
            <div>
                <label for="firstName">Prénom:</label>
                <input type="text" id="firstName" v-model="user.firstName">
            </div>
            <div>
                <label for="name">Nom de famille:</label>
                <input type="text" id="name" v-model="user.name">
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" v-model="user.email">
            </div>
            <div>
                <label for="password">Mot de passe (laisser vide si inchangé):</label>
                <input type="password" id="password" v-model="user.password">
            </div>
            <div class="submit-form">
                <button type="submit">Sauvegarder</button>
            </div>
        </form>
    </div>
</template>


<script setup>
import { ref, onMounted } from 'vue';
import { jwtDecode } from "jwt-decode";

const runtimeConfig = useRuntimeConfig();
const url = runtimeConfig.apiUrl || runtimeConfig.public?.apiUrl;
const user = ref({});
let token;

// Charger les données de l'utilisateur
async function loadUserData() {
    try {
        const decoded = jwtDecode(token);
        const userId = decoded.user_id;
        
        const response = await fetch(`${url}users/${userId}`, {
            headers: { 'Authorization': `Bearer ${token}` }
        });
        if (!response.ok) throw new Error('Failed to fetch user data');
        const userData = await response.json();
        user.value = userData; // Stocker les données dans une réactivité ref
        user.value.id = userId; // Stocker l'ID de l'utilisateur
    } catch (err) {
        console.error('Error fetching user data:', err);
    }
}
async function submitForm() {
    // Vérifier que user.value.id est défini
    if (!user.value.id) {
        alert('Erreur : ID utilisateur non défini.');
        return;
    }

    try {
        const response = await fetch(`${url}users/${user.value.id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            },
            body: JSON.stringify({
                name: user.value.name,
                firstName: user.value.firstName,
                email: user.value.email
            })
        });
        if (!response.ok) throw new Error('Failed to update user data');
        alert('Informations mises à jour avec succès!');
    } catch (err) {
        console.error('Error updating user data:', err);
        alert('Erreur lors de la mise à jour des informations.');
    }
}
// Exécuter la fonction au montage du composant
onMounted(() => {
  token = localStorage.getItem('token');
  loadUserData();
});
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