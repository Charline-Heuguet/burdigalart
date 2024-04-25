<template>
    <div v-if="user">
        <div class="avatar">
            <img :src="user.picture" alt="avatar de l'utilisateur">
            <p> Bonjour {{ user.firstName }} !</p>
        </div>
        <!-- <input type="text" v-model="user.name" placeholder="Nom">
        <input type="text" v-model="user.firstName" placeholder="Prénom">
        <input type="text" v-model="user.email" placeholder="Email">
         -->
         <!-- PARAMETRES -->
        <!-- <NuxtLink to="/profil/parametres">
            <div class="setting">
                <img src="/img/icon-settings.svg" alt="Paramètres">
                <p> Paramètres de votre compte.</p>
            </div>
        </NuxtLink> -->
    </div>
    <div v-else>
        <p>Chargement...</p>
    </div>
</template>

<script setup>
import { useAsyncData } from 'nuxt/app';

const baseURL = 'https://localhost:8000/api/';

// ATTENTION : L'ID de l'utilisateur est fixé à 1 pour le moment !!! A CHANGER
const { data: user, error } = await useAsyncData('user', () => fetch(baseURL + 'users/3').then(res => res.json()));

if (error.value) {
    console.error('Erreur lors de la récupération des données:', error.value);
}

const email = ref('');

</script>

<style scoped lang="scss">
@import 'assets/base/colors';

.avatar{
    display: flex;
    align-items: center;
    margin: 20px 0 40px 0;
    
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