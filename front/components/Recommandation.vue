<template>
    <div class="recommandation">
        <!-- TODO: etre en dynamique -->
        <NuxtLink to="/">
            <div class="card-reco">
                <img class="artist-photo" src="/medias/artistPhotoOfficielle.jpg" alt="">
                <h1>Nom de l'artiste</h1>
                <p> Categorie</p>
            </div>
        </NuxtLink>
        <div class="card-reco">
            <img class="artist-photo" src="/medias/artistPhotoOfficielle.jpg" alt="">
            <h1>Nom de l'artiste</h1>
            <p> Categorie</p>
        </div>
    </div>
</template>
<script setup lang="ts">
// Faire l'appel API pour les recommandations
</script>
<style scoped lang="scss">
.recommandation {
    display: flex;
}

.card-reco {
    text-align: center;
    margin-right: 25px;
    max-width: 150px;
    border: 1px solid black;
    border-radius: 10px;      
    h1{
        margin-top: 5px;
        margin-bottom: 5px;
    }
}
.artist-photo {
    border-radius: 10px 10px 0 0;
    width: 100%;
    height: auto;
    overflow: hidden;
}
</style>