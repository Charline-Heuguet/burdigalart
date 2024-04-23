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
    <Accordion v-for="(item, index) in items" :key="index">
      <template #title>
        <p>{{ item.title }}</p>
      </template>
      <template #content>
        <div v-if="item.title === 'Vos évènements à venir'">
          <div v-if="eventsData && eventsData.events" v-for="(event, index) in eventsData.events" :key="index"
            class="event">
            <!-- DIV 1 : dateicon -->
            <DateIcon :dateTime="event.dateTime" />
            <!-- DIV2: TITRE ET LIEU -->
            <div class="event-info">
              <h3>{{ event.title }}</h3>
              <p class="event-location">{{ event.scene.name }}: {{ event.scene.address }}</p>
            </div>
            <Arrow class="event-arrow" />
          </div>
          <div v-else>
            Chargement des évènements...
          </div>
        </div>
        <div v-else-if="item.title === 'Votre historique'">
          <p>Contenu de l'historique ici.</p>
        </div>
      </template>
    </Accordion>
  </div>



  <!-- Accordeon pour les artistes -->
  <div v-if="currentRole === 'Artiste'" v-for="(item, index) in itemsArtist" :key="index">
    <Accordion :item="item">
      <template #title>
        <p>{{ item.title }}</p>
      </template>
      <template #content>
        <p>{{ item.content }}</p>
      </template>
    </Accordion>
  </div>

  <!-- Accordeon pour les gérants de scène -->
  <div v-if="currentRole === 'Gérant de scène'" v-for="(item, index) in itemsManager" :key="index">
    <Accordion :item="item">
      <template #title>
        <p>{{ item.title }}</p>
      </template>
      <template #content>
        <p>{{ item.content }}</p>
      </template>
    </Accordion>
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
import Arrow from '~/components/ui/Arrow.vue';
import DateIcon from '~/components/ui/DateIcon.vue';
import { ref } from 'vue';

const baseURL = 'https://localhost:8000/api';

const currentRole = ref('Spectateur'); // L'utilisateur est "Spectateur" par défaut

const items = [
  { title: 'Vos évènements à venir' },
  { title: 'Votre historique' }
];

// ATTENTION : l'ID de l'utilisateur est en dur pour le moment !! A CHANGER !
const { data: eventsData, pending, error } = useAsyncData('userEvents', () => {
  return $fetch(baseURL + '/users/3');
});


const itemsArtist = [
  { title: 'Votre fiche d\'artiste', content: 'Contenu 1' },
  { title: 'Votre spectacle', content: 'Contenu 2' },
  { title: 'Vos évènements à venir', content: 'Contenu 3' },
  { title: 'Votre historique', content: 'Contenu 4' },
  { title: 'Votre abonnement', content: 'Contenu 5' }
];

const itemsManager = [
  { title: 'La fiche de votre scene', content: 'Contenu 1' },
  { title: 'Les évènements à venir', content: 'Contenu 2' },
  { title: 'Votre historique', content: 'Contenu 3' },
  { title: 'Votre abonnement', content: 'Contenu 3' }
];

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
  padding: 12px 12px 60px 12px;
  border-bottom: 1px solid $darkgray;

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

.arrow {
  cursor: pointer;
  height: auto;
  width: 15px;
  position: absolute;
  bottom: 0;
  transition: transform 0.1s;
  transform: scale(1); // Échelle normale, supprime le centrage
}

.arrow-top,
.arrow-bottom {
  background-color: $mandarin;
  height: 4px;
  position: absolute;
  top: 50%;
  width: 100%;
  transform: translateY(-50%); // Centre verticalement
}
</style>