<template>
  <div class="parent">
    <h2>Burdigal'Art</h2>
    <h3>Découvrez et soutenez les artistes qui façonnent la scène musicale de demain.</h3>
    <!-- Les prochains évènement -->
    <UpComingEvent />
    <!-- Les artistes à la une -->
    <TopArtists />
    <!-- WAVES -->
    <!-- <div class="custom-shape-divider-bottom-1713957316">
      <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path
          d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
          class="shape-fill"></path>
      </svg>
    </div> -->
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
definePageMeta({
  layout: "home",
});
</script>

<style scoped lang="scss">
@import 'assets/base/colors';

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

.custom-shape-divider-bottom-1713957316 {
    position: absolute;
    bottom: 0;
    left: 0;
    overflow: hidden;
    line-height: 0;
    transform: rotate(180deg);
}

.custom-shape-divider-bottom-1713957316 svg {
    position: relative;
    display: block;
    width: calc(330% + 1.3px);
    height: 500px;
}

.custom-shape-divider-bottom-1713957316 .shape-fill {
    fill: #ee831962;
}

/** For mobile devices **/
// @media (max-width: 767px) {
//     .custom-shape-divider-bottom-1713957316 svg {
//         width: calc(330% + 1.3px);
//         height: 600px;
//         z-index: -1;
//     }
// }
</style>