<template>
  <section class="top-artists">
    <div class="headings">
      <h3>Les artistes à la une</h3>
      <NuxtLink to="/nouveautes">
        <Pastille>Voir plus</Pastille>
      </NuxtLink>
    </div>
    <swiper :slidesPerView="1.5" :spaceBetween="30" :breakpoints="breakpoints" :loop="true" class="mySwiper">
      <swiper-slide v-for="artist in artists" :key="artist.id" class="slide">
        <div v-if="artist.subscription === true">
          <NuxtLink :to="'/artiste/' + artist.slug">
            <img :src="artist.officialPhoto" alt="" class="artist-photo">
            <div class="text-content">
              <p class="artist-name">{{ artist.artistName }}</p>
              <TagStyle class="card-tags" :style="artist.style.styleName" />
            </div>
          </NuxtLink>
        </div>
      </swiper-slide>
    </swiper>
  </section>
</template>


<script setup lang="ts">
import 'swiper/css';
import 'swiper/css/pagination';
import 'swiper/css/navigation';
import { ref, watchEffect } from 'vue';
import { Swiper, SwiperSlide } from 'swiper/vue';
import Pastille from '~/components/ui/pastille.vue';
import TagStyle from '~/components/ui/TagStyle.vue';
import type { Artist } from '~/types/interfaces/artist';

const runtimeConfig = useRuntimeConfig();
const url = runtimeConfig.apiUrl || runtimeConfig.public?.apiUrl;

// Utilisation de useAsyncData pour la récupération des données de façon asynchrone
const { data: artistsData } = useAsyncData<Artist>(() => {
  return $fetch(url + 'artists/');
});

// Création d'une référence reactive pour les artistes, initialisée à un tableau vide
const artists = ref<Artist[]>([]);

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
    slidesPerView: 2.6,
    spaceBetween: 20
  },
  768: {  // à partir de 768px
    slidesPerView: 3.3,
    spaceBetween: 30
  },
  1024: {  // à partir de 1024px
    slidesPerView: 3,
    spaceBetween: 40
  },
  1280: {  // à partir de 1280px
    slidesPerView: 3.5,
    spaceBetween: 20
  },
};
</script>

<style scoped lang="scss">
@import 'assets/base/colors';
.top-artists{
  position: relative;
}
.headings {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 25px 0;

  h3 {
    flex: 1;
    margin: 0;
    position: relative;
    z-index: 999;
  }
}

.artist-name {
  font-size: 18px;
  text-align: center;
}

.card-tags {
  text-align: center;
  padding: 0;
}

.mySwiper .swiper-slide {
  position: relative;
  height: 200px;
  border-radius: 10px;
  overflow: hidden;

  &>div{
    height: 100%;
  }

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
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .artist-name {
    margin: 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
}

.pastille {
  background-color: $pink;
  font-weight: 600;
  color: $beigeclair;
  letter-spacing: .03em;
  position: relative;
  z-index: 999;
}
</style>