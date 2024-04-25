<template>
  <div class="rolesPills">
    <RolePill role="Spectateur" :isActive="currentRole === 'Spectateur'" @selected="role => { currentRole = role }" />
    <RolePill role="Artiste" :isActive="currentRole === 'Artiste'" @selected="role => { currentRole = role }" />
    <RolePill role="Gérant de scène" :isActive="currentRole === 'Gérant de scène'"
      @selected="role => { currentRole = role }" />
  </div>

  <div v-if="currentRole === 'Spectateur'">
    <ProfilBase />
  </div>


  <!-- Accordeon pour les spectateurs -->
  <div v-if="currentRole === 'Spectateur'">
    <AccordionViewer />
  </div>
    



  <!-- Accordeon pour les artistes -->
  <div v-if="currentRole === 'Artiste'">
    <AccordionArtist />
  </div>

  <!-- Accordeon pour les gérants de scène -->
  <div v-if="currentRole === 'Gérant de scène'">
    
  </div>

  <NuxtLink to="/profil/parametres">
    <div class="setting">
      <img src="/img/icon-settings.svg" alt="Paramètres">
      <p> Paramètres de votre compte.</p>
    </div>
  </NuxtLink>

</template>

<script setup>
import RolePill from '~/components/profiles/RolePill.vue';
import ProfilBase from '~/components/profiles/ProfilBase.vue';
import Accordion from '~/components/profiles/Accordion.vue';
import AccordionViewer from '~/components/profiles/AccordionViewer.vue';
import AccordionArtist from '~/components/profiles/AccordionArtist.vue';
import DateIcon from '~/components/ui/DateIcon.vue';
import { ref } from 'vue';

const baseURL = 'https://localhost:8000/api';

const currentRole = ref('Spectateur'); // L'utilisateur est "Spectateur" par défaut


// ATTENTION : l'ID de l'utilisateur est en dur pour le moment !! A CHANGER !
const { data: eventsData, pending, error } = useAsyncData('userEvents', () => {
  return $fetch(baseURL + '/users/3');
});


</script>

<style scoped lang="scss">
@import 'assets/base/colors';

.rolesPills {
  display: flex;
  flex-wrap: nowrap;
  justify-content: space-around;
  overflow-x: auto;

  &::-webkit-scrollbar {
    display: none;
  }
}

.setting {
  display: flex;
  align-items: center;
  margin: 40px 0;

  img {
    width: 20px;
    height: auto;
    margin-right: 15px;
  }
}

.event {
  position: relative;
  display: flex;
  padding: 20px;
  border-bottom: 1px solid $darkgray;
  background-color: white;

  .event-arrow {
    position: absolute;
    top: 40%;
    right: 0;
    width: 30px;
    height: auto;
  }

  .event-info {
    display: flex;
    flex-direction: column;
    justify-content: space-around;
    margin-left: 15px;

    h3 {
      margin-bottom: 5px;
    }

    .event-location {
      font-size: 0.9rem;
      color: $darkgray;
    }
  }
}
</style>