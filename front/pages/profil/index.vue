<template>
    <div class="rolesPills">
        <RolePill role="Spectateur" :isActive="currentRole === 'Spectateur'"
            @selected="role => { currentRole = role }" />
        <RolePill role="Artiste" :isActive="currentRole === 'Artiste'" @selected="role => { currentRole = role }" />
        <RolePill role="Gérant de scène" :isActive="currentRole === 'Gérant de scène'"
            @selected="role => { currentRole = role }" />
    </div>
    <!-- <Accordion /> -->

    <ProfilBase />


    <div v-for="(item, index) in items" :key="index">
      <TestAccordion :item="item">
        <template #title>
          <h3>{{ item.title }}</h3>
        </template>
        <template #content>
          <p>{{ item.content }}</p>
        </template>
      </TestAccordion>
    </div>






</template>

<script setup>
import RolePill from '~/components/profiles/RolePill.vue';
import ProfilBase from '~/components/profiles/ProfilBase.vue';
import Accordion from '~/components/ui/Accordion.vue';
import TestAccordion from '~/components/profiles/TestAccordion.vue';
import { ref } from 'vue';


const items = [
    { title: 'Titre 1', content: 'Contenu 1' },
    { title: 'Titre 2', content: 'Contenu 2' },
    { title: 'Titre 3', content: 'Contenu 3' }
];
const currentRole = ref('Spectateur'); // L'utilisateur est "Spectateur" par défaut
</script>

<style scoped lang="scss">
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