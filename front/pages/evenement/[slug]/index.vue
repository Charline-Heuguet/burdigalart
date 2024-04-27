<template>
    <div>
        <div v-if="events && !error">
            <h1>{{ events.title }}</h1>
            <p>{{ events.description }}</p>
            <img :src="events.poster" alt="">
            <div class="infos">
                <div class="info-event">
                    <img src="/img/icon-marker.svg" alt="">
                    <p>{{ events.scene.address }} <br> {{ events.scene.zipcode }} {{ events.scene.town }}</p>
                </div>
                <div class="info-event">
                    <img src="/img/icon-calendar.svg" alt="">
                    <p>Le {{ formatDateTime(events.dateTime) }}h</p>
                </div>
                <div class="info-event">
                    <img src="/img/icon-euro2.svg" alt="symbole de la monnaie euro">
                    <p>{{ events.price.toFixed(2) }} euros</p>
                </div>
            </div>
            <div v-if="events.Artist.length > 0">
                <h2>Vous les verrez sur scène :</h2>
                <div v-for="artist in events.Artist" :key="artist.slug" class="show">
                    <div class="photo">
                        <img :src="artist.officialPhoto" alt="">
                        <div class="namestyle">
                            <p>{{ artist.artistName }}</p>
                            <p class="style">{{ artist.style.styleName }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bouton "Réserver" qui amène au panier -->
            <NuxtLink to="/panier">
                <button>Réserver</button>
            </NuxtLink>

        </div>
    </div>
</template>

<script setup>
import dayjs from 'dayjs';

// LES CONSTANTES
const route = useRoute(); //useRoute permet de récupérer les paramètres de l'URL
const slug = route.params.slug; // On récupère le slug de l'URL
const baseURL = 'https://localhost:8000/api/';

const formatDateTime = (dateTime) => {
    return dayjs(dateTime).format('DD/MM à HH:mm');
};

const { data: events, error } = useFetch(baseURL + 'events/' + slug);
console.log(events);
</script>

<style scoped lang="scss">
@import 'assets/base/colors';

h1 {
    font-size: 40px;
    text-align: center;
}

h2 {
    font-size: 28px;
    text-align: center;
}

img {
    width: 100%;
    height: auto;
    margin: 20px 0;
}

.infos {
    margin: 10px 0;
    padding: 10px 0;
    border-top: $darkgray 1px solid;
    border-bottom: $darkgray 1px solid;

    .info-event {
        display: flex;
        align-items: center;

        p {
            font-size: 16px;
        }


        img {
            width: 25px;
            height: auto;
            margin-right: 10px;
        }
    }
}

.photo {
    position: relative;
    width: 100%;
    height: 300px; 
    margin-bottom: 30px;
    

    img {
        width: 100%; // prend la largeur totale du parent
        height: 100%; // prend la hauteur totale du parent
        object-fit: cover; // assure que l'image couvre la dimension du parent sans perdre son ratio
        object-position: center; // centre l'image dans le cadre
    }

    .namestyle {
        position: absolute;
        display: flex;
        align-items: center;
        justify-content: space-between;
        top: 0;
        left: 0;
        width: 100%;
        padding: 10px;
        background-color: rgba(0, 0, 0, 0.2);
        backdrop-filter: blur(5px);
        text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.5);
        color: white;

        .style {
            border: 1px solid $orange;
            background-color: $orange;
            border-radius: 100px;
            margin-left: 20px;
            padding: 2px 5px;
            min-width: 100px;
            text-align: center;
        }
    }
}

button {
    background-color: $mandarin;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    font-size: 20px;
    margin: 20px 0;
    cursor: pointer;
    width: 100%;
}
</style>