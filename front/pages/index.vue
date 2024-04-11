<template>
  <div>
    <h2>Burdigal'Art</h2>
    <!-- Les prochains évènement -->
    <h3>Les prochains évènements</h3>
    <OnGoingEvent />
    <!-- Les artistes à la une -->
    <h3>Les artistes à la une</h3>
    <TopArtists />

  </div>
</template>

<script setup>
// Définition de la meta de la page
definePageMeta({
  layout: 'custom'
});

// IMPORTS
import OnGoingEvent from '~/components/OnGoingEvent.vue';
import TopArtists from '~/components/TopArtists.vue';

// Appel de l'API

// USEFETCH marche avec le SSR à false
//const { data: artists } = useFetch('https://localhost:8000/api/artists');
// const { data: upcomingEvents } = useFetch('https://localhost:8000/api/scenes/allupcoming');

// SSR à true
// let artists = ref([]);
// try {
//   artists = await $fetch('https://localhost:8000/api/artists');
// } catch (error) {
//   error.value = error;
// }
</script>

<style scoped lang="scss">
h2 {
  text-align: center;
  margin: 15px 0 25px 0;
}
h3 {
  margin: 25px 0 15px 0;
}

.artist {
  border: 1px solid black;
  border-radius: 10px;
  margin: 20px 0;
  overflow: hidden;

  .artist-name {
    font-size: 20px;
    text-align: center;
  }

  .styletag {
    text-align: center;
  }
}

.mySwiper .swiper-slide {
  position: relative;
  height: 200px;

  img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .text-content {
    position: absolute;
    top: 0;
    left: 0;
    padding: 10px;
    background-color: rgba(0, 0, 0, 0.5);
    color: white;
    width: 100%;
    box-sizing: border-box;
  }

  .artist-name,
  .styletag {
    margin: 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
}
</style>