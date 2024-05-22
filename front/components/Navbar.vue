<template>
  <nav class="navbar">
    <ul class="nav-list">
      <li class="nav-item">
        <NuxtLink to="/" class="nav-link">
          <img src="/img/icon-home.svg" alt="Home" class="nav-icon" />
          <span class="nav-text">Accueil</span>
        </NuxtLink>
      </li>
      <li class="nav-item">
        <NuxtLink to="/scenes" class="nav-link">
          <img src="/img/icon-scene4.svg" alt="Scenes" class="nav-icon" />
          <span class="nav-text">Scènes</span>
        </NuxtLink>
      </li>
      <li class="nav-item">
        <NuxtLink to="/nouveautes" class="nav-link">
          <img src="/img/icon-new.svg" alt="Nouveautés" class="nav-icon" />
          <span class="nav-text">Nouveautés</span>
        </NuxtLink>
      </li>
      <li class="nav-item">
        <NuxtLink v-if="isAuthenticated" to="/profil" class="nav-link">
          <img src="/img/icon-profil.svg" alt="Profil" class="nav-icon" />
          <div class="profile-container">
            <span class="nav-text">Profil</span>
            <div v-if="showProfileAlert" class="alert-icon"></div>
          </div>
        </NuxtLink>
        <NuxtLink v-else to="/connexion" class="nav-link">
          <img src="/img/icon-login.svg" alt="Login" class="nav-icon" />
          <span class="nav-text">Connexion</span>
        </NuxtLink>
      </li>
    </ul>
  </nav>
</template>

<script setup lang="ts">
import { computed } from 'vue';
import { useAuthStore } from '~/stores/auth';

const authStore = useAuthStore();
const isAuthenticated = computed(() => authStore.isAuthenticated);
const user = computed(() => authStore.user);

// Propriété calculée pour déterminer si une alerte doit être affichée
const showProfileAlert = computed(() => {
  if (!isAuthenticated.value || !user.value) return false;
  const hasUnsubscribedArtist = user.value.artists?.some(artist => !artist.subscription);
  const hasUnsubscribedScene = user.value.scenes?.some(scene => !scene.subscription);
  return hasUnsubscribedArtist || hasUnsubscribedScene;
});
</script>



<style lang="scss">
@import 'assets/base/colors';

.navbar {
  padding: 4px 0;
  box-shadow: 0 -5px 15px rgba(0, 0, 0, 0.5);
  position: fixed;
  bottom: 0;
  right: 0;
  left: 0;
  background-color: $black;
  z-index: 999999999999999;

  .nav-list {
    list-style: none;
    display: flex;
    justify-content: space-around;
    margin: 0;
    padding: 0;

    .nav-item {
      text-align: center;

      .nav-link {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 5px;

        .nav-icon {
          width: auto;
          height: 20px;
          margin-bottom: 5px; // Espace entre l'icône et le texte
        }

        .profile-container {
          display: flex;
          align-items: center;
        }

        .alert-icon {
          width: 10px;
          height: 10px;
          background-color: #9e0101;
          border-radius: 50%;
          display: flex;
          justify-content: center;
          align-items: center;
          color: white;
          font-size: 24px;
          margin-left: 5px; // Espace entre le point rouge et le texte
        }

        .nav-text {
          text-transform: uppercase;
          letter-spacing: 1px;
          color: $beigeclair;
          font-size: 15px;
        }
      }
    }
  }
}


@media (min-width:993px) {
  .navbar {
    position: absolute;
    top: 400px;
    transform: translateY(-100%);
    left: 0;
    right: 0;
    height: fit-content;
    background-color: rgba(0, 0, 0, 0.472);
    backdrop-filter: blur(5px);
    box-shadow: 15px 5px 15px rgba(100, 100, 100, 0.5);

    .nav-list {
      margin: 20px;

      .nav-item {
        .nav-link {
          display: flex;
          flex-direction: row;
          justify-items: center;

          .nav-icon {
            padding-right: 10px;
          }

          .nav-text {
            color: $beigeclair;
            font-size: 20px;
            font-weight: 600;
            margin-top: 0;
          }
        }
      }
    }
  }
}


@media (min-width: 1030px) {
  .navbar {
    .nav-list {
      justify-content: space-between;
      max-width: 1140px;
      margin: 0 auto;
      padding: 20px
    }
  }
}
</style>