<template>
  <div>
    <swiper :slidesPerView="1.5" :spaceBetween="30" :breakpoints="breakpoints" :loop="false" :modules="modules" class="mySwiper">
      <swiper-slide v-for="artist in artists" :key="artist.id" class="slide">
        <NuxtLink :to="'/artiste/' + artist.slug">
          <img :src="artist.officialPhoto" alt="" class="artist-photo">
          <div class="text-content">
            <p class="artist-name">{{ artist.artistName }}</p>
            <TagStyle class="styletag" :style="artist.style.styleName" />
          </div>
        </NuxtLink>
      </swiper-slide>
    </swiper>
  </div>
</template>


<script setup>
// IMPORTS
import TagStyle from '~/components/ui/TagStyle.vue';
import { Swiper, SwiperSlide } from 'swiper/vue';
import 'swiper/css'; // Importe les styles de base de Swiper
import 'swiper/css/pagination';
import 'swiper/css/navigation';

const baseURL = 'https://localhost:8000/api/';

// Appel de l'API
const { data: artists } = useFetch(baseURL + 'artists');

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
</style>