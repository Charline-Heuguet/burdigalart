<template>
    <div v-if="pending">Chargement...</div>
    <div v-else-if="error">Erreur : {{ error }}</div>
    <div v-else>
        <h2>Nos prochains événements:</h2>
        <div class="container-artist">
            <div v-for="event in sceneData.events" :key="event.id" class="event">
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
                            <!-- <img src="/img/icon-euro.svg" alt="euro" /> -->
                            <p>{{ event.price.toFixed(2) }}€</p>
                        </div>
                    </div>
                </NuxtLink>
            </div>
        </div>
    </div>
</template>

<script setup>
import dayjs from 'dayjs';
import { useAsyncData } from 'nuxt/app';

const runtimeConfig = useRuntimeConfig();
const url = runtimeConfig.apiUrl || runtimeConfig.public?.apiUrl;

const route = useRoute(); //useRoute permet de récupérer les paramètres de l'URL
const slug = route.params.slug; // On récupère le slug de l'URL


// Utiliser useAsyncData pour récupérer les données de manière asynchrone
const { data: sceneData, pending, error } = useAsyncData('scene-events', () => {
    return $fetch(url + 'scenes/' + slug);
});

const formatDateTime = (dateTime) => {
    return dayjs(dateTime).format('DD/MM à HH:mm');
};
</script>


<style scoped lang="scss">
@import 'assets/base/colors';

.event {
    border-radius: 10px;
    overflow: hidden;
    margin-bottom: 25px;
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