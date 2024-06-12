<template>
    <section>
        <!-- Page d'un artiste-->
        <div v-if="artiste && !error">
            <div class="presentation">
                <img :src="artiste.officialPhoto" :alt="`photo officielle de ${artiste.artistName}`">
                <div class="artist-info">
                    <h1>{{ artiste.artistName }}</h1>
                    <TagStyle v-if="artiste.style" :style="artiste.style.styleName" class="card-tags" />
                </div>
            </div>
        </div>
        <div v-else-if="error">
            <p>Erreur : Impossible de charger les données de l'artiste.</p>
        </div>
        <!-- Description -->
        <h2 class="description" v-if="artiste"> {{ artiste.description }}</h2>

        <!-- EXTRAIT VIDEO -->
        <div class="ar16-9">
            <iframe class="video-wrapper" v-if="artiste && artiste.linkExcerpt"
                :src="`https://www.youtube.com/embed/${getYoutubeID(artiste.linkExcerpt)}`" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen>
            </iframe>
        </div>

        <!-- MAIL -->
        <NuxtLink to="/contact">
            <div class="mail">
                <img class="icon" src="/img/icon-envelop.svg" alt="enveloppe">
                <p>Des encouragements? Une collab' ? Contactez-moi !</p>
            </div>
        </NuxtLink>

        <!-- SPECTACLE DE L'ARTISTE -->
        <h2> Son spectacle: </h2>
        <Show />

        <h2>Vous pouvez voir cet.te artiste ici:</h2>
        <div v-if="artiste && artiste.events">
            <div class="container-artist">
                <div v-for="event in artiste.events" :key="event.id" class="card">
                    <NuxtLink :to="`/evenement/${event.slug}`">
                        <div class="ar16-9">
                            <img :src="event.poster" :alt="event.title" />
                        </div>
                        <h3>{{ event.title }}</h3>
                        <p class="description-event">{{ event.description }}</p>
                        <div class="infos">
                            <div class="date">
                                <img src="/img/icon-calendar.svg" alt="calendrier" />
                                <p>{{ formatDateTime(event.dateTime) }}</p>
                            </div>
                            <div class="price">
                                <p>{{ event.price.toFixed(2) }}€</p>
                            </div>
                        </div>
                    </NuxtLink>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import dayjs from 'dayjs';
import { useRoute } from 'vue-router'
import TagStyle from '~/components/ui/TagStyle.vue'

// Récupération de l'url de l'API
const runtimeConfig = useRuntimeConfig();
const url = runtimeConfig.apiUrl || runtimeConfig.public?.apiUrl;

// Récupération des données de l'artiste
const route = useRoute(); //useRoute permet de récupérer les paramètres de l'URL
const slug = route.params.slug; // Récupération du slug de l'URL

const { data: artiste, error } = useAsyncData('artist', async () => {
    const response = await fetch(url + 'artists/' + slug);
    if (!response.ok) {
        throw new Error('Network response was not ok');
    }
    return response.json();
});

// Fonction pour formater la date et l'heure
const formatDateTime = (dateTime: string) => {
    return dayjs(dateTime).format('DD/MM à HH:mm');
};

// Fonction pour récupérer l'ID de la vidéo Youtube
function getYoutubeID(url : string) {
    const regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
    const match = url.match(regExp);
    return (match && match[7].length == 11) ? match[7] : null;
}

// Pour le titre de l'onglet
const { toTitleCase } = useUtilities();
useHead({
    title: toTitleCase(route.params.slug)
});
</script>

<style scoped lang="scss">
@import 'assets/base/colors';

.presentation {
    padding-top: 20px;
    display: flex;

    .artist-info {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    h1 {
        font-size: 25px;
    }

    img {
        width: 350px;
        height: auto;
        border-radius: 10px;
        margin-right: 15px;
        object-fit: cover;
    }
}

.description {
    margin: 50px 10px;
    letter-spacing: 0.02em;
    font-size: 18px;
    font-weight: 400;
}

h2 {
    margin: 25px 0;
}

.icon {
    width: 30px;
    height: 30px;
}

.mail {
    display: flex;
    margin: 55px 0;
    align-items: center;

    .icon {
        margin-right: 15px;
    }
}

.video-wrapper {
    border: 1px solid $darkgray;
    box-shadow: 0 0 10px $darkgray;
}


.container-artist {
    border-radius: 10px;
    overflow: hidden;
    margin-bottom: 25px;
    width: calc(50% - 20px);
    background-color: $beigeclair;
    box-shadow: 0 0 30px 0 rgba(0, 0, 0, 0.3);

    h3 {
        text-align: center;
        margin-top: 12px;
    }

    .infos {
        display: flex;
        justify-content: space-between;
        padding: 5px;
    }

    .description-event {
        padding: 0 8px;
        overflow: hidden;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 3;
    }

    .date,
    .price {
        display: flex;
        align-items: center;

        img {
            width: 20px;
            height: auto;
            margin-right: 10px;
        }
    }

    .price {
        background-color: $canard;
        text-align: center;
        border-radius: 100px;
        color: $beigeclair;
        width: 60px;
        height: 60px;
        padding: 3px;

        p {
            margin: 0 auto;
            font-size: 16px;
        }

    }
}

@media (min-width: 680px) {
    .container-artist {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;

        .event {
            width: calc(50% - 20px);
        }
    }
}
</style>