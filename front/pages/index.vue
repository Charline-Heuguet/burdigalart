<template>
  <div>
    <h2>Burdigal'Art</h2>
    <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis, illum. </h3>
    <!-- Les prochains évènement -->
    <div class="headings">
      <h3>Les prochains évènements</h3>
      <NuxtLink to="/evenement">
        <Pastille>Voir plus</Pastille>
      </NuxtLink>
    </div>
    <UpComingEvent />
    <!-- Les artistes à la une -->
    <div class="headings">
      <h3>Les artistes à la une</h3>
      <NuxtLink to="/nouveautes">
        <Pastille>Voir plus</Pastille>
      </NuxtLink>
    </div>
    <TopArtists />

  </div>
</template>

<script setup>
// Définition de la meta de la page
definePageMeta({
  layout: 'custom'
});

// IMPORTS
import UpComingEvent from '~/components/UpComingEvent.vue';
import TopArtists from '~/components/TopArtists.vue';
import Pastille from '~/components/ui/pastille.vue';

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
@import 'assets/base/colors';

.headings {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 25px 0;

  h3 {
    flex: 1;
    margin: 0;
  }
}

h2 {
  text-align: center;
  margin: 15px 0 25px 0;
}

h3 {
  margin: 40px 0 15px 0;
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
.pastille {
  background-color: $black;
  color: $beigeclair;
}
</style>