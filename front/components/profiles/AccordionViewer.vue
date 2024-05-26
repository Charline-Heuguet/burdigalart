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
import { ref, onMounted, computed } from 'vue';
import { jwtDecode } from "jwt-decode";

const runtimeConfig = useRuntimeConfig();
const apiUrl = runtimeConfig.apiUrl || runtimeConfig.public?.apiUrl;

const userInfo = ref(null);
const error = ref(null);

const loadUserData = async () => {
  const token = localStorage.getItem('token');
  if (!token) {
    console.error('No token found');
    return;
  }

  try {
    const decoded = jwtDecode(token);
    const userId = decoded.user_id;
    const response = await fetch(`${apiUrl}users/${userId}`, {
      headers: { 'Authorization': `Bearer ${token}` }
    });
    if (!response.ok) throw new Error('Failed to fetch user data');
    userInfo.value = await response.json();
  } catch (err) {
    error.value = err.message;
    console.error('Error fetching user data:', err.message);
  }
};

onMounted(loadUserData);

const now = new Date();
const upcomingEvents = computed(() => {
  return userInfo.value && userInfo.value.events ? userInfo.value.events.filter(event => new Date(event.dateTime) > now) : [];
});

const pastEvents = computed(() => {
  return userInfo.value && userInfo.value.events ? userInfo.value.events.filter(event => new Date(event.dateTime) <= now) : [];
});
</script>


<style scoped lang="scss">
@import 'assets/base/colors';
.event {
  display: flex;
  align-items: center;
  justify-content: space-between;
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
