<template>
    <div class="participation">
        <img src="" alt="">
        <h1>Nom de l'artiste</h1>
        <p class="category">Categorie</p>
        <div class="date">
            <img class="icon" src="/img/icon-calendar.png" alt="date">
            <p>Date de l'event</p>
        </div>
        <div class="place">
            <img class="icon" src="/img/icon-pointeur.svg" alt="pointeur">
            <p>Lieu de l'event</p>
        </div>
    </div>
</template>

<style scoped lang="scss">
.participation {
    border: 1px solid black;
    border-radius: 10px;
    padding: 10px;
    max-width: 200px;
    
    h1, p{
        text-align: center;
        margin-bottom: 5px;
        margin-top: 5px;
    }

    .date,.place {
        display: flex;
        align-items: center;
        .icon{
            width: 30px;
            height: auto;
        }

        img{
            margin-right: 15px;
        }
    }
}

</style>