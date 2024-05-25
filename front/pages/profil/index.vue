<template>
  <div class="rolesPills">
    <!-- Afficher les pastilles basées sur les rôles de l'utilisateur -->
    <RolePill role="Spectateur" :isActive="currentRole === 'Spectateur'" @selected="role => { currentRole = role }"
      v-if="authStore.roles.includes('ROLE_USER')" />
    <RolePill role="Artiste" :isActive="currentRole === 'Artiste'" @selected="role => { currentRole = role }"
      v-if="authStore.roles.includes('ROLE_ARTISTE')" />
    <RolePill role="Gérant de scène" :isActive="currentRole === 'Gérant de scène'"
      @selected="role => { currentRole = role }" v-if="authStore.roles.includes('ROLE_SCENE')" />
  </div>

  <!-- Contenu conditionnel basé sur le rôle sélectionné -->
  <div class="profil-view" v-if="currentRole === 'Spectateur'">
    <ProfilBase />
    <AccordionViewer />
    <NuxtLink to="/profil/parametres">
      <div class="setting">
        <img src="/img/icon-setting.svg" alt="Paramètres">
        <p> Paramètres de votre compte.</p>
      </div>
    </NuxtLink>
  </div>

  <div class="profil-view" v-if="currentRole === 'Artiste'">
    <AccordionArtist />
  </div>

  <div class="profil-view" v-if="currentRole === 'Gérant de scène'">
    <AccordionManager />
  </div>
</template>

<script setup>
import { useAuthStore } from '~/stores/auth'; // Importer le store d'authentification
import RolePill from '~/components/profiles/RolePill.vue';
import ProfilBase from '~/components/profiles/ProfilBase.vue';
import AccordionArtist from '~/components/profiles/AccordionArtist.vue';
import AccordionViewer from '~/components/profiles/AccordionViewer.vue';
import AccordionManager from '~/components/profiles/AccordionManager.vue';
import { ref } from 'vue';

const authStore = useAuthStore(); // Utiliser le store pour accéder aux rôles
const currentRole = ref('Spectateur'); // L'utilisateur est "Spectateur" par défaut

</script>


<style scoped lang="scss">
@import 'assets/base/colors';

.profil-view {
  max-width: 600px;
  margin: 30px auto 0;
  padding: 20px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
  background-color: rgba(247, 241, 235, 0.7);
  border-radius: 8px;
}

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
  margin: 40px auto;
  max-width: 450px;

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