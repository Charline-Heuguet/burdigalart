<template>
    <div>
        <div v-if="pending">Chargement...</div>
        <div v-else-if="error">Erreur : {{ error }}</div>
        <div v-else>
            <div v-for="event in sceneData.events" :key="event.id" class="event">
                <NuxtLink :to="`/evenement/${event.slug}`">
                    <div class="ar16-9">
                        <img :src="event.poster" :alt="event.title" />
                    </div>
                    <h3>{{ event.title }}</h3>
                    <p class="line-clamp-2">{{ event.description }}</p>
                    <div class="infos">
                        <div class="date">
                            <img src="/img/icon-calendar.svg" alt="calendrier" />
                            <p>{{ formatDateTime(event.dateTime) }}</p>
                        </div>
                        <div class="price">
                            <!-- <img src="/img/icon-euro.svg" alt="euro" /> -->
                            <p>{{ event.price.toFixed(2)  }}€</p>
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
// import Booking from '~/components/ui/Booking.vue';

const baseURL = 'https://localhost:8000/api/';
const slugScene = 'le-petit-grain';

// Utiliser useAsyncData pour récupérer les données de manière asynchrone
const { data: sceneData, pending, error } = useAsyncData('scene-events', () => {
  return $fetch(`${baseURL}scenes/${slugScene}`);
});

const formatDateTime = (dateTime) => {
  return dayjs(dateTime).format('DD/MM à HH:mm');
};
</script>


<style scoped lang="scss">
@import 'assets/base/colors';

.event {
    border: 1px solid black;
    border-radius: 10px;
    overflow: hidden;
    margin-bottom: 25px;

    h3{
        text-align: center;
        margin-top: 12px;
    }
    
    
    p {
        padding:4px;
    }

    .infos {
        display: flex;
        justify-content: space-between;
        padding: 5px;
    }
    .date, .price{
        display: flex;
        align-items: center;

        img{
            width: 20px;
            height: auto;
            margin-right: 10px;
        }
    }

    .price{
        background-color: $canard;
        text-align: center;
        border-radius: 100px;
        color: $beigeclair;
        width: 60px;
        height: 60px;
        padding: 3px;
        p{
            margin: 0 auto;
            font-size: 16px;
        }

    }
}
</style>