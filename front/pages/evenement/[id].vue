<!-- Page d'un évenement -->
<template>
    <div>
        <img src="/medias/eventBanner.jpg" alt="">
        <h1>Nom de l'event</h1>
        <div class="place">
            <img class="icon" src="/img/icon-pointeur.svg" alt="pointeur">
            <p>Lieu de l'event</p>
        </div>
        <div class="date">
            <img class="icon" src="/img/icon-calendar.png" alt="date">
            <p>Date de l'event</p>
        </div>
        <div class="duration">
            <img class="icon" src="/img/icon-duration.svg" alt="durée">
            <p>Durée de l'event</p>
        </div>
        <p class="description">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate, fugiat. Eligendi eveniet nihil sunt corporis doloremque, repudiandae iure a nisi fugiat? Est earum nemo eos maiores deleniti! Perspiciatis, doloremque error?
        </p>
        <h2>Vous les verrez sur scène :</h2>
        <ArtistEvent />
    </div>
</template>

<style scoped lang="scss">
h1{
    text-align: center;
    margin: 5px 0;
}
.duration, .date, .place{
    display: flex;
    align-items: center;
    padding-left: 15px;
    margin: 5px 0;
    .icon{
        width: 30px;
        height: auto;
        margin-right: 15px;
    }
}

.description {
    margin: 20px 0;
}
</style>