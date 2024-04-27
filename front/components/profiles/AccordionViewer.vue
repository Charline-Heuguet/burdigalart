<template>
  <div>
    <Accordion :item="{title: 'Événements à venir', content: ''}" v-slot:content>
      <div v-for="event in upcomingEvents" :key="event.slug" class="event">
        <DateIcon :dateTime="event.dateTime" />
        <div>
          <h3>{{ event.title }}</h3>
          <p>{{ event.scene.name }} - {{ event.scene.address }}</p>
        </div>
        <NuxtLink :to="'/evenement/' + event.slug">
          <img src="/img/icon-arrow-next.svg" alt="flèche vers la droite" />        
        </NuxtLink>
      </div>
      <p class="nothing" v-if="upcomingEvents.length === 0">Aucun événement à venir.</p>
    </Accordion>
    <Accordion :item="{title: 'Historique', content: ''}" v-slot:content>
      <div v-for="event in pastEvents" :key="event.slug" class="event">
        <DateIcon :dateTime="event.dateTime" />
        <div>
          <h3>{{ event.title }}</h3>
          <p>{{ event.scene.name }} - {{ event.scene.address }}</p>
        </div>
        <NuxtLink :to="'/evenement/' + event.slug">
          <img src="/img/icon-arrow-next.svg" alt="flèche vers la droite" />
        </NuxtLink>
      </div>
      <p class="nothing" v-if="pastEvents.length === 0">Aucun événement passé.</p>
    </Accordion>
  </div>
</template>

<script setup>
import Accordion from './Accordion.vue';
import DateIcon from '../ui/DateIcon.vue';
import { ref, computed } from 'vue';
import { useAsyncData } from 'nuxt/app';

const baseURL = 'https://localhost:8000/api';
const userId = 1; // Utilisateur pour les tests en dur

const { data, error, pending } = useAsyncData('userEvents', () => {
  return $fetch(`${baseURL}/users/${userId}`);
});

const upcomingEvents = computed(() => {
  return data.value ? data.value.events.filter(event => new Date(event.dateTime) > new Date()) : [];
});
//console.log(upcomingEvents);

const pastEvents = computed(() => {
  return data.value ? data.value.events.filter(event => new Date(event.dateTime) <= new Date()) : [];
});
</script>

<style scoped lang="scss">
@import 'assets/base/colors';
.event {
  display: flex;
  align-items: center;
  gap: 1rem;
  padding: 1rem;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
  

  img {
    width: 1.5rem;
  }
}

  .nothing{
    padding: 12px;
  }
  
</style>
