<template>
  <section class="wave-container">
    <div class="headings">
      <h3>Les artistes à la une</h3>
      <NuxtLink to="/nouveautes">
        <Pastille>Voir plus</Pastille>
      </NuxtLink>
    </div>
    <swiper :slidesPerView="1.5" :spaceBetween="30" :breakpoints="breakpoints" :loop="true" :modules="modules"
      class="mySwiper">
      <swiper-slide v-for="artist in artists" :key="artist.id" class="slide">
        <div v-if="artist.subscription===true">
          <NuxtLink :to="'/artiste/' + artist.slug">
            <img :src="artist.officialPhoto" alt="" class="artist-photo">
            <div class="text-content">
              <p class="artist-name">{{ artist.artistName }}</p>
              <TagStyle class="styletag" :style="artist.style.styleName" />
            </div>
          </NuxtLink>
        </div>
      </swiper-slide>
    </swiper>
  </section>
</template>


<script setup lang="ts">
import { ref, watchEffect } from 'vue';
import Pastille from '~/components/ui/pastille.vue';
import TagStyle from '~/components/ui/TagStyle.vue';
import { Swiper, SwiperSlide } from 'swiper/vue';
import 'swiper/css'; // Importe les styles de base de Swiper
import 'swiper/css/pagination';
import 'swiper/css/navigation';

const baseURL = 'https://localhost:8000/api/';

// Utilisation de useAsyncData pour la récupération des données de façon asynchrone
const { data: artistsData } = useAsyncData(() => {
  return $fetch(`${baseURL}artists`);
});

const artists = ref([]);

// Réaction aux changements de artistsData pour filtrer les artistes
// watchEffect est utilisé pour surveiller les changements dans les données récupérées (artistsData). Dès que ces données changent, le code à l'intérieur de watchEffect est exécuté.
watchEffect(() => {
  if (artistsData.value) {
    artists.value = artistsData.value.filter(artist => artist.subscription === true);
  }
});

// Breakpoints pour Swiper
const breakpoints = {
  500: {  // à partir de 640px
    slidesPerView: 2,
    spaceBetween: 20
  },
  768: {  // à partir de 768px
    slidesPerView: 3,
    spaceBetween: 30
  },
  1024: {  // à partir de 1024px
    slidesPerView: 4,
    spaceBetween: 40
  },
};
</script>

<style scoped lang="scss">
@import 'assets/base/colors';

// .wave-container {  
//   height: 40vh;
//   background-color: #63bda9;
//   position: relative;
// }

// .wave-container::before {   
//   content: "";
//   width: 100%;
//   height: 168px;
//   position: absolute;
//   bottom: -0.3%;
//   left: 0;
//   background-size: auto;
//   background-repeat: repeat no-repeat;
//   background-position: 100vw bottom;
//   background-image: url("data:image/svg+xml;utf8,<svg viewBox='0 0 1200 134' fill='none' xmlns='http://www.w3.org/2000/svg'><path d='M0 1C19.5523 3 32.2291 5 51.5 9C104.5 19 200 43 300 65C400 88 500 111 600 102C700 93 800 53 900 30C987.526 5 1085.36 -1 1150 0C1169.54 -1 1180.49 0 1200 1V134H1150C1100 134 1000 134 900 134C800 134 700 134 600 134C500 134 400 134 300 134C200 134 100 134 50 134H0V1.98128Z' fill='%23EDDACA'/></svg>");
// }

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

.artist-name {
  font-size: 18px;
  text-align: center;
}

.styletag {
  text-align: center;
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
    text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.5);
    position: absolute;
    bottom: 0;
    left: 0;
    padding: 10px;
    background-color: rgba(0, 0, 0, 0.2);
    backdrop-filter: blur(5px);
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
  font-weight: 600;
  color: $beigeclair;
  letter-spacing: .03em;
}
</style>