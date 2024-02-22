<!-- Sur la page d'un évenement d'une scène, composant qui fait suite à "Vous les verrez sur scène" sur event/id -->
<template>
    <div class="show">
        <div class="photo">
            <img src="/medias/artistPhotoOfficielle.jpg" alt="artiste">
        </div>
        <div class="nom-show">
            <h1>Nom de l'artiste</h1>
        </div>        
    </div>
    <div class="show">
        <div class="photo">
            <img src="/medias/artistPhotoOfficielle.jpg" alt="artiste">
        </div>
        <div class="nom-show">
            <h1>Nom de l'artiste</h1>
        </div>        
    </div>
    <div class="button">
        <NuxtLink to="/panier">
            <button type="button">Réserver</button>
        </NuxtLink>
        
    </div>
</template>

<style scoped lang="scss">
@import 'assets/base/colors';
.show {
    border: 1px solid black;
    margin-bottom:20px;
    .photo{
        background-image: url('/medias/artistPhotoOfficielle.jpg');
        position: relative;
        padding-top: 100%;
        overflow: hidden;
        
        img{
            position: absolute;
            width: 100%;
            top:0
        }
    }
    .nom-show {
        display: flex;
        justify-content: center;
        margin: 20px 0;
    }
}

button {
    width: 50%;
    border-radius: 50px;
    padding: 10px;
    background-color: $mandarin;
    border: 1px solid $mandarin;
    cursor: pointer;
}
.button{
    text-align: center;
    margin: 50px 0;
}
</style>

