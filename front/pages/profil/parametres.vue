<template>
    <div class="profil-modif">
        <h2> Paramètres de votre compte</h2>
        <NuxtLink to="/profil/modifier-informations">
            <div class="update">
                <img src="/img/icon-pencil.svg" alt="un crayon à papier">
                <p>Modifier vos informations personnelles</p>
            </div>
        </NuxtLink>
        <div class="logout" @click="logout">
      <img src="/img/icon-logout.svg" alt="une fleche qui sort d'un rectangle">
      <p>Se déconnecter</p>
    </div>
        <NuxtLink to="/profil/supprimer-compte">
            <div class="delete">
                <img src="/img/icon-delete.svg" alt="un profil avec une croix dans le coin droit">
                <p> Supprimer votre compte</p>
            </div>
        </NuxtLink>
    </div>
</template>

<script setup>
import { useAuthStore } from '~/stores/auth';

const { logout } = useAuthStore();
</script>

<style scoped lang="scss">
@import 'assets/base/colors';

.profil-modif {

    h2 {
        margin: 40px 0 60px 0;
        text-align: center;
    }

    .update,
    .delete,
    .logout {
        display: flex;
        max-width: 450px;
        margin: 0 auto 16px;
        align-items: center;
        padding: 15px 10px;
        background-color: $beigeclair;
        box-shadow: 0 0 30px 0 rgba(0, 0, 0, 0.3);

        img {
            width: 20px;
            height: auto;
            margin-right: 15px;
        }
    }
}
</style>