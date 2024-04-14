<template>
    <div>
        <h1>Les évènements à venir</h1>
        <div v-for="allEvent in upcomingEvents" :key="allEvent.id" class="event">
            <NuxtLink :to="'/evenement/' + allEvent.slug" >
                <img :src="allEvent.poster" alt="affiche de l'évènement">
                <div class="text-content">
                    <p class="event-name">{{ allEvent.title }} au {{ allEvent.scene.name }}</p>
                    <p class="event-date">Le {{ formatDateTime(allEvent.dateTime) }}</p>
                </div>
            </NuxtLink>
        </div>
    </div>
</template>

<script setup>
import dayjs from 'dayjs';

const formatDateTime = (dateTime) => {
    return dayjs(dateTime).format('DD/MM à HH:mm');
};
const baseURL = 'https://localhost:8000/api/';

const { data: upcomingEvents } = useFetch(baseURL + 'events/upcoming');
console.log(upcomingEvents);
</script>

<style scoped lang="scss">
@import 'assets/base/colors';

h1 {
    font-size: 35px;
    margin-bottom: 30px;
}

.event {
    border: 1px solid $darkgray;
    margin-bottom: 20px;
    position: relative;

    .text-content {
        position: absolute;
        bottom: 0;
        left: 0;
        padding: 10px;
        width: 100%;
        border-top: 1px solid $darkgray;
        background-color: rgba(0, 0, 0, 0.2);
        backdrop-filter: blur(5px);
        text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.5);
        color: white;
        letter-spacing: 1px;
    }
}
</style>