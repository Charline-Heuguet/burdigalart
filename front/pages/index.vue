<template>
  <div>
    <h2>Découvrez et soutenez les artistes qui façonnent la scène musicale de demain.</h2>
    <!-- LISTES D'ARTISTES -->
    <div class="grid">
      <div v-for="artist in artists" :key="artist.id" class="artist grid-item">
        <img :src="artist.officialPhoto" alt="">
        <p class="artist-name">{{ artist.artistName }} </p>
        <TagStyle class="styletag " :style="artist.style.styleName" />
      </div>
    </div>

  </div>
</template>

<script setup>
// Définition de la meta de la page
definePageMeta({
  layout: 'custom'
});

// IMPORTS
import TagStyle from '~/components/ui/TagStyle.vue';
// import Swiper from 'swiper';


// Appel de l'API

// SSR à true
// let artists = ref([]);
// try {
//   artists = await $fetch('https://localhost:8000/api/artists');
// } catch (error) {
//   error.value = error;
// }

// USEFETCH marche avec le SSR à false
const { data: artists } = useFetch('https://localhost:8000/api/artists');
console.log('artistes presents', artists);




</script>

<style scoped lang="scss">
h1 {
  margin-top: 30px;
  text-align: center;
}

h2 {
  margin: 15px 0 5px 0;
}

.artist {
  border: 1px solid black;
  border-radius: 10px;
  margin: 20px 0;
  overflow: hidden;

  img {
    width: 100%;
    height: auto;
    object-fit: cover;
  }

  .artist-name {
    font-size: 20px;
    text-align: center;
  }

  .styletag {
    text-align: center;
  }
}
</style>