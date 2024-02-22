<template>
    <div class="event">
        <img src="/medias/eventBanner.jpg" alt="">
        <h1>Nom de l'evenement</h1>
        <div class="date">
            <p>Date de l'event</p>
        </div>
        <div class="place">
            <p>Lieu de l'event</p>
        </div>
    </div>
</template>

<style scoped lang="scss">
.event {
    margin: 15px;
    border: 1px solid black;
    border-radius: 10px;
    max-width: 100%;
    overflow: hidden;

    img {
        width: 100%;
    }

    h1,
    p {
        text-align: center;
        margin: 5px 0;
    }

    .date,.place {
        display: flex;
        align-items: center;
        padding-left: 15px;
    }
}
</style>