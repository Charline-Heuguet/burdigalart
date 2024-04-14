<template>
  <div>
    <swiper :slidesPerView="1.5" :spaceBetween="30" :breakpoints="breakpoints" :loop="true" :modules="modules" class="mySwiper">
      <swiper-slide v-for="allEvent in upcomingEvents" :key="allEvent.id" class="slide">
        <img :src="allEvent.poster" alt="affiche de l'évènement">
        <div class="text-content">
          <p class="event-name">{{ allEvent.title }} au {{ allEvent.scene.name }}</p>
          <p class="event-date">Le {{ formatDateTime(allEvent.dateTime) }}</p>
        </div>
      </swiper-slide>
    </swiper>
  </div>
</template>
<script setup>
import { Swiper, SwiperSlide } from 'swiper/vue';
import 'swiper/css/pagination';
import 'swiper/css/navigation';
import dayjs from 'dayjs';

const formatDateTime = (dateTime) => {
  return dayjs(dateTime).format('DD/MM à HH:mm');
};
const baseURL = 'https://localhost:8000/api/';

const { data: upcomingEvents } = useFetch(baseURL + 'events/upcoming');

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
  1020: {  // à partir de 1024px
    slidesPerView: 4,
    spaceBetween: 40
  },
};
</script>

<style scoped lang="scss">
@import 'assets/base/colors';


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
    bottom: 0;
    left: 0;
    padding: 5px;
    background-color: rgba(0, 0, 0, 0.2);
    backdrop-filter: blur(5px);
    text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.5);
    color: white;
    width: 100%;

    .event-name {
      font-size: 18px;
    }
    .event-date{
      font-size: 15px;
    }
    
  }

  .artist-name,
  .styletag {
    margin: 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
}

.slide{
  border: 1px solid $darkgray;
}

.mySwiper{
  margin-bottom: 40px;
}
</style>