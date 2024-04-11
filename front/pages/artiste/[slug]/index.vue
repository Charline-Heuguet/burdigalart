<template>
    <section>
        <!-- PHOTO + NOM + CATEGORY -->
        <div v-if="artiste && !error">
            <div class="presentation">
                <img :src="artiste.officialPhoto" :alt="`photo officielle de ${artiste.artistName}`">
                <div>
                    <h1>{{ artiste.artistName }}</h1>
                    <TagCategory :category="artiste.category.categoryName" />
                    <TagStyle :style="artiste.style.styleName" />
                </div>
            </div>
        </div>
        <div v-else-if="error">
            <p>Erreur : Impossible de charger les données de l'artiste.</p>
        </div>
        <!-- Description -->
        <p class="description"> Lorem ipsum dolor, sit amet consectetur adipisicing elit. Expedita aperiam aliquid aut
            maiores explicabo esse, consectetur nostrum earum excepturi aspernatur. Illo error ipsam nam pariatur
            corporis culpa nulla aspernatur magni. </p>

        <!-- EXTRAIT VIDEO -->
        <video controls src="">Vidéo extrait de l'artiste</video>
        <!-- RESEAUX -->
        <!-- <div>
            <div class="reseaux">
                <NuxtLink :to="`https://www.instagram.com/${artiste.instagram}/`">
                    <img class="icon" src="/img/icon-yt.svg" alt="youtube">
                </NuxtLink>
                <NuxtLink :to="`https://www.instagram.com/${artiste.instagram}/`">
                    <img class="icon" src="/img/icon-insta.svg"
                        alt="un appareil photo blanc sur un fond degradé de rose violet jaune">
                </NuxtLink>
                <NuxtLink :to="`https://www.facebook.com/${artiste.facebook}/`">
                    <img class="icon" src="/img/icon-fb.svg" alt="un f minuscule de couleur bleue">
                </NuxtLink>
            </div>
        </div> -->
        <!-- MAIL -->
        <div class="mail">
            <!-- Mettre un NuxtLink pour diriger vers le formulaire de contact -->
            <img class="icon" src="/img/icon-envelop.svg" alt="enveloppe">
            <p>Si une collaboration vous interesse, contactez-moi !</p>
        </div>
        <h2> Son spectacle: </h2>
        <!-- TODO: Mettre un NuxtLink pour diriger vers le [ShowTitle] -->
        <!-- <NuxtLink :to="`/artiste/${showData.slug}/${showData.showTitle}`"> -->
        <Show />
        <!-- </NuxtLink> -->
        <h2> Vous pouvez voir cet.te artiste ici:</h2>
        <Event />
        <!-- <h3> Ses recommandations: </h3>
        <Recommandation /> -->
    </section>
</template>

<script setup lang="ts">
import { useRoute } from 'vue-router'
import TagCategory from '~/components/ui/TagCategory.vue'
import TagStyle from '~/components/ui/TagStyle.vue'
import type { Artist } from '~/types/interfaces/artist';

const baseURL = 'https://localhost:8000/api/';

// LES CONSTANTES
const route = useRoute(); //useRoute permet de récupérer les paramètres de l'URL
const slug = route.params.slug; // On récupère le slug de l'URL
const { data: artiste, error } = useFetch<Artist>(baseURL + 'artists/' + slug);
//console.log(artiste);


// Pour le titre de l'onglet
const { toTitleCase } = useUtilities();
useHead({
    title: toTitleCase(route.params.slug)
});
</script>

<style scoped lang="scss">
.presentation {
    padding-top: 20px;
    display: flex;

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
    margin: 20px 10px;
}

h2 {
    margin: 25px 0;
}

.reseaux {
    margin-top: 25px;
    margin-bottom: 15px;
    display: flex;
    justify-content: space-around;

    .icon {
        margin-right: 15px;
    }
}

.icon {
    width: 30px;
    height: 30px;
}

.mail {
    display: flex;
    margin: 25px 0;

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