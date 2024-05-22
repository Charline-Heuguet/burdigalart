<template>
    <section>
        <!-- Page d'un artiste-->
        <div v-if="artiste && !error">
            <div class="presentation">
                <img :src="artiste.officialPhoto" :alt="`photo officielle de ${artiste.artistName}`">
                <div class="artist-info">
                    <h1>{{ artiste.artistName }}</h1>
                    <!-- <TagCategory v-if="artiste.category" :category="artiste.category.categoryName" /> -->
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
        <Event />
    </section>
</template>

<script setup lang="ts">
import { useRoute } from 'vue-router'
import TagCategory from '~/components/ui/TagCategory.vue'
import TagStyle from '~/components/ui/TagStyle.vue'
import type { Artist } from '~/types/interfaces/artist';

// Récupération de l'url de l'API
const runtimeConfig = useRuntimeConfig();
const url = runtimeConfig.apiUrl || runtimeConfig.public?.apiUrl;

// Récupération des données de l'artiste
const route = useRoute(); //useRoute permet de récupérer les paramètres de l'URL
const slug = route.params.slug; // On récupère le slug de l'URL

const { data: artiste, error } = useAsyncData('artist', async () => {
    const response = await fetch(url + 'artists/' + slug);
    if (!response.ok) {
        throw new Error('Network response was not ok');
    }
    return response.json();
});

// Fonction pour récupérer l'ID de la vidéo Youtube
function getYoutubeID(url) {
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
        width: 185px;
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
</style>