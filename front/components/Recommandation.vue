<template>
    <div class="recommandation">
        <div class="card-reco">
            <img class="artist-photo" src="/medias/artistPhotoOfficielle.jpg" alt="">
            <h1>Nom de l'artiste</h1>
            <p> Categorie</p>
        </div>
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
<style>
.recommandation {
    display: flex;
}

.card-reco {
    margin-right: 25px;
    max-width: 150px;
    border: 1px solid black;
    border-radius: 10px;
}
.artist-photo {
    
    border-radius: 10px;
    width: 100%;
    height: auto;
    overflow: hidden;
}
</style>