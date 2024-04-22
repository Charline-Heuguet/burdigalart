<template>
  <div class="parent">
    <h2>Burdigal'Art</h2>
    <h3>Lorem ipsum dolor sit amet consectetur adipis icing elit. Reiciendis, illum. </h3>
    <!-- Les prochains évènement -->
    <UpComingEvent />
    <!-- Les artistes à la une -->
    <TopArtists />
  </div>
</template>

<script setup>


// IMPORTS
import UpComingEvent from '~/components/UpComingEvent.vue';
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
  font-size: 23px;
  margin: 40px 0 15px 0;
}

//pour le wave
.parent {
  position: relative;
}


</style>