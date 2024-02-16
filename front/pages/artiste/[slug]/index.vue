<template>
    <section>
        <div>
            <img src="" alt="">
            <h1>Nom de l'artiste</h1>
            <TagCategory />
            <p> Lorem ipsum dolor, sit amet consectetur adipisicing elit. Expedita aperiam aliquid aut maiores explicabo esse, consectetur nostrum earum excepturi aspernatur. Illo error ipsam nam pariatur corporis culpa nulla aspernatur magni. </p>
        </div>
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
        <video src="">Vidéo extrait de l'artiste</video>
        <p> Si une collaboration vous interesse, contactez-moi</p>
        <span>
            <img class="icon" src="/img/icon-envelop.svg" alt="enveloppe">
            <p>mail@arti.ste</p>
        </span>
        <h2> Vous pouvez le voir ici:</h2>
        <Participation />
        <h2> Ses recommandations: </h2>
        <Recommandation />
    </section>
</template>
<script setup lang="ts">
</script>
<style>
.reseaux {
    display: flex;
}
.icon {
    width: 50px;
    height: 50px;
}
</style>