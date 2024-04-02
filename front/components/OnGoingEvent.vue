<template>
  <div>
    <swiper :slidesPerView="1.5" :spaceBetween="30" :loop="true" :modules="modules" class="mySwiper">
      <swiper-slide v-for="allEvent in upcomingEvents" :key="allEvent.id" class="slide">
        <img :src="allEvent.eventPoster" alt="" class="affiche de l'évènement">
        <div class="text-content">
          <p class="event-date">{{ allEvent.DateTime }}</p>
          <p class="event-name">{{ allEvent.eventTitle }}</p>
        </div>
      </swiper-slide>
    </swiper>
  </div>
</template>
<script setup>
import { Swiper, SwiperSlide } from 'swiper/vue';
import 'swiper/css'; // Importe les styles de base de Swiper
import 'swiper/css/pagination';
import 'swiper/css/navigation';

const baseURL = 'https://localhost:8000/api/';

const { data: upcomingEvents } = useFetch(baseURL + 'scenes/allupcoming');

</script>

<style scoped lang="scss">
.artist-name {
  font-size: 20px;
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
    position: absolute;
    top: 0;
    left: 0;
    padding: 5px;
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