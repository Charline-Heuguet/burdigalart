<template>
    <div class="error-404">
        <NuxtLink to="/">
            <img src="/img/logo-rond.png" alt="note de musique représentée par une clé de sol de couleur noir, entourée d'un rond jaune avec quelques notes musicales autour" class="logo" />
            <p>Retour à l'accueil</p>
        </NuxtLink>
            
    </div>
</template>

<script setup>
definePageMeta({
  layout: '',
})
</script>

<style scoped lang="scss">
@import 'assets/base/colors';

.error-404 {
    background-image: url('/medias/page404.webp');
    height: 100vh;
    background-size: cover;
    background-position: center;

    .logo{
        width: 100px;
        display: block;
        margin: 0 auto;
    }

    p{
        color: white;
        text-align: center;
        font-size: 20px;
        margin-top: 20px;
    }
}
</style>