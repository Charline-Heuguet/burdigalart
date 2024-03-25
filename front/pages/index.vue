<template>
  <div>
    <h2>Découvrez et soutenez les artistes qui façonnent la scène musicale de demain.</h2>
    <!-- LISTES D'ARTISTES -->

    <!-- <div v-for="artist in artists" :key="artist.id" class="artist grid-item">
      <img :src="artist.officialPhoto" alt="">
      <p class="artist-name">{{ artist.artistName }} </p>
      <TagStyle class="styletag " :style="artist.style.styleName" />
    </div> -->

    <div>
      <h2>Les artistes à la une</h2>
      <swiper :slidesPerView="1.5" :spaceBetween="30" :loop="true" :modules="modules" class="mySwiper">
        <swiper-slide v-for="artist in artists" :key="artist.id" class="slide">
          <img :src="artist.officialPhoto" alt="" class="artist-photo">
          <div class="text-content">
            <p class="artist-name">{{ artist.artistName }}</p>
            <TagStyle class="styletag" :style="artist.style.styleName" />
          </div>
        </swiper-slide>
      </swiper>
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
import { Swiper, SwiperSlide } from 'swiper/vue';
import 'swiper/css'; // Importe les styles de base de Swiper
import 'swiper/css/pagination';
import 'swiper/css/navigation';

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
  margin: 25px 0;
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
  position: relative; /* Établit un contexte de positionnement pour le texte absolument positionné */
  height: 300px; /* Ou toute autre hauteur que tu souhaites pour tes slides */
  
  img {
    width: 100%;
    height: 100%; /* Assure que l'image couvre tout le slide */
    object-fit: cover; /* Garde le ratio de l'image tout en couvrant le slide */
  }

  .text-content {
    position: absolute; /* Positionne le texte par-dessus l'image */
    top: 0; /* Aligné en haut */
    left: 0; /* Aligné à gauche */
    padding: 10px; /* Un peu d'espace autour du texte */
    background-color: rgba(0, 0, 0, 0.5); /* Fond semi-transparent pour améliorer la lisibilité */
    color: white; /* Couleur du texte */
    width: 100%; /* Assure que le conteneur du texte s'étend correctement */
    box-sizing: border-box; /* S'assure que le padding est inclus dans la largeur définie */
  }

  .artist-name, .styletag {
    margin: 0; /* Élimine les marges par défaut pour un alignement serré */
    white-space: nowrap; /* Empêche le texte de passer à la ligne si tu le souhaites */
    overflow: hidden; /* Cache le texte qui dépasse la largeur du conteneur */
    text-overflow: ellipsis; /* Ajoute des ellipses pour le texte débordant */
  }
}

</style>