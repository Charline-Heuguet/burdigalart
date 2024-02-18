<template>
    <section>
        <div class="presentation">
            <img src="/medias/artistPhotoOfficielle.jpg" alt="photo officielle de l'artiste">
            <div>
                <h1>Nom de l'artiste</h1>
                <TagCategory />
            </div>            
        </div>
        <p> Lorem ipsum dolor, sit amet consectetur adipisicing elit. Expedita aperiam aliquid aut maiores explicabo esse, consectetur nostrum earum excepturi aspernatur. Illo error ipsam nam pariatur corporis culpa nulla aspernatur magni. </p>
        <div class="reseaux">
            <a href="https://www.youtube.com">
                <img class="icon" src="/img/icon-yt.svg" alt="youtube">
            </a>
            <a href="">
                <img class="icon" src="/img/icon-insta.svg" alt="instagram">
            </a>
            <a href="">
                <img class="icon" src="/img/icon-fb.svg" alt="facebook">
            </a>
        </div>
        <video controls src="">Vidéo extrait de l'artiste</video>
        <div class="mail">
            <img class="icon" src="/img/icon-envelop.svg" alt="enveloppe">
            <p>Si une collaboration vous interesse, contactez-moi !</p>
        </div>
        <h2> Vous pouvez le voir ici:</h2>
        <Participation />
        <h2> Ses recommandations: </h2>
        <Recommandation />
    </section>
</template>

<script setup lang="ts">
</script>

<style scoped lang="scss">
.presentation {
    padding-top: 20px;
    display: flex;
    h1{
        font-size: 25px;
    }    
    img{
        max-width: 130px;
        border-radius: 10px;
        margin-right: 15px;
    }
}
p{
    margin-top: 20px;
}
h2 {
    margin-top: 20px;
    margin-bottom: 15px;
}
.reseaux {
    margin-top: 15px;
    margin-bottom: 15px;
    display: flex;
    justify-content: space-evenly;
    .icon{
        margin-right: 15px;
    }
}
.icon {
    width: 30px;
    height: 30px;
}
.mail {
    display: flex;
    align-items: center;
    margin-top: 10px;
    margin-bottom: 10px;
    .icon {
        margin-right: 15px;
    }
}

video {
    display: block;
    margin: 0 auto;
    border: 1px solid black;
    border-radius: 10px;
}
</style>