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
  <div v-if="currentRole === 'Spectateur'" v-for="(item, index) in items" :key="index">
    <Accordion :item="item">
      <template #title>
        <p>{{ item.title }}</p>
      </template>
      <template #content>
        <p>{{ item.content }}</p>
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

</template>

<script setup>
import RolePill from '~/components/profiles/RolePill.vue';
import ProfilBase from '~/components/profiles/ProfilBase.vue';
import Accordion from '~/components/profiles/Accordion.vue';
import { ref } from 'vue';


const items = [
  { title: 'Vos évènements à venir', content: 'Contenu 1' },
  { title: 'Votre historique', content: 'Contenu 2' }
];


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

const currentRole = ref('Spectateur'); // L'utilisateur est "Spectateur" par défaut
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


</style>