<template>
    <div v-if="user">
        <div class="avatar">
            <p class="h2" v-if="isLogged">Bonjour {{ user.firstName }} !</p>
            <p class="h3">Ici, retrouves tous tes évènements!</p>
        </div>
    </div>
    <div v-else>
        <p>Chargement...</p>
    </div>
</template>

<script setup>
import { useAsyncData } from 'nuxt/app';
import { jwtDecode } from "jwt-decode";

const baseURL = 'https://localhost:8000/api/';

// ATTENTION : L'ID de l'utilisateur est fixé à 1 pour le moment !!! A CHANGER
const { data: user, error } = await useAsyncData('user', () => fetch(baseURL + 'users/3').then(res => res.json()));

if (error.value) {
    console.error('Erreur lors de la récupération des données:', error.value);
}

const email = ref('');
// On récupère le token stocké dans le localStorage
const token = JSON.stringify(localStorage.getItem('token'));

function isJwtValid(token) {
    try {
        const decodedToken = jwtDecode(token);
        const currentTime = Date.now() / 1000;
        return decodedToken.exp > currentTime;
    } catch (error) {
        console.error('Error decoding JWT:', error);
        return false;
    }
}
const isLogged = isJwtValid(token);

</script>

<style scoped lang="scss">
@import 'assets/base/colors';

.avatar{
    margin: 20px auto 40px;
    text-align: center;
    
    img{
        width: 150px;
        height: auto;
        margin-right: 10px;
        border-radius: 20px;
        margin-right: 30px;
    }
}
input{
    width: 40%;
    margin: 10px ;
    padding: 5px 5px 5px 10px;
    border: 1px solid $darkgray;
    border-radius: 10px;
    background-color: rgba(216, 215, 215, 0.458);
}
label{
    visibility: hidden;
}
#email{
    width: 85%;
}
.setting{
    display: flex;
    align-items: center;
    margin: 40px 0;
    img{
        width: 20px;
        height: auto;
        margin-right: 15px;
    }
}

</style>