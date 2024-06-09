<template>
  <div class="upcoming">
    <div class="headings">
      <h3>Les prochains évènements</h3>
      <NuxtLink to="/evenement">
        <Pastille>Voir plus</Pastille>
      </NuxtLink>
    </div>
    <swiper :slidesPerView="1.5" :spaceBetween="30" :breakpoints="breakpoints" :loop="true" class="mySwiper">
      <swiper-slide v-for="allEvent in upcomingEvents" :key="allEvent.id" class="slide">
        <NuxtLink :to="'/evenement/' + allEvent.slug">
          <img :src="allEvent.poster" alt="affiche de l'évènement">
          <div class="text-content">
            <p class="event-name">"{{ allEvent.title }}" à {{ allEvent.scene.name }}</p>
            <p class="event-date">Le {{ formatDateTime(allEvent.dateTime) }}</p>
          </div>
        </NuxtLink>
      </swiper-slide>
    </swiper>
  </div>
</template>

<script setup>
import Pastille from '~/components/ui/pastille.vue';
import { Swiper, SwiperSlide } from 'swiper/vue';
import 'swiper/css/pagination';
import 'swiper/css/navigation';
import dayjs from 'dayjs';

// Ici, on récupère l'url de l'API depuis le fichier de configuration
const runtimeConfig = useRuntimeConfig();
const url = runtimeConfig.apiUrl || runtimeConfig.public?.apiUrl;

const formatDateTime = (dateTime) => {
  return dayjs(dateTime).format('DD/MM à HH:mm');
};

const { data: upcomingEvents } = useAsyncData(() => {
  return $fetch(url + 'events/upcoming')
});

// Breakpoints pour Swiper
const breakpoints = {
  500: { 
    slidesPerView: 2.3,
    spaceBetween: 20
  },
  768: {  
    slidesPerView: 3.3,
    spaceBetween: 30
  },
  1024: { 
    slidesPerView: 3,
    spaceBetween: 40
  },
  1280: { 
    slidesPerView: 3.2,
    spaceBetween: 20
  },
};
</script>

<style scoped lang="scss">
@import 'assets/base/colors';

.upcoming{
  margin: 40px 0;

}

.headings {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 25px 0;

  h3 {
    flex: 1;
    margin: 0;
  }
  .pastille {
    background-color: $turquoise;
    font-weight: 600;
    color: $black;
    letter-spacing: .03em;
  }
}


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

  .artist-name, .styletag {
    margin: 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
}

.slide{
  border-radius: 10px;
  overflow: hidden;
  //box-shadow: 4px 2px 5px rgba(0, 0, 0, 0.5);
}

.mySwiper{
  margin-bottom: 40px;

  
}
</style>