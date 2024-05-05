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
        <NuxtLink to="/profil" class="nav-link">
          <img src="/img/icon-profil.svg" alt="Profil" class="nav-icon" />
          <div class="profile-container">
            <span class="nav-text">Profil</span>
            <div v-if="showProfileAlert" class="alert-icon"></div>
          </div>
        </NuxtLink>
      </li>
    </ul>
  </nav>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue';
import type { User, Artist, Scene } from '~/types/interfaces';

// Simuler la récupération d'un utilisateur spécifique EN DUR pour tester

// ARTISTE SANS ABONNEMENT: Sophie Bodin
const currentUser = ref<User>({
  id: 3,
  name: "Édouard Aubert",
  firstName: "Honoré",
  picture: "https://fastly.picsum.photos/id/219/5000/3333.jpg",
  email: "dominique.wagner@free.fr",
  artists: [
    {
      artistName: "Sophie Bodin",
      slug: "sophie-bodin",
      subscription: false
    }
  ],
  scenes: []
});

// Propriété calculée pour déterminer si une alerte doit être affichée
const showProfileAlert = computed(() => {
  const hasUnsubscribedArtist = currentUser.value.artists.some(artist => !artist.subscription);
  const hasUnsubscribedScene = currentUser.value.scenes.some(scene => !scene.subscription);
  return hasUnsubscribedArtist || hasUnsubscribedScene;
});

// ARTISTE AVEC ABONNEMENT: Eleonore Perrin (essai avec une scene non abonnée et une abonnée également.)
// const currentUser = ref<User>({
//   id: 90,
//   name: "Alexandria-Anne Loiseau",
//   firstName: "Diane",
//   picture: "https://via.placeholder.com/640x480.png/0044ff?text=cats+ipsa",
//   email: "marie.hortense@orange.fr",
//   artists: [
//     {
//       artistName: "Éléonore Perrin",
//       slug: "eleonore-perrin",
//       subscription: true
//     },
//     {
//       artistName: "Corinne Rodriguez-Martinez",
//       slug: "corinne-rodriguez",
//       subscription: true
//     }
//   ],
//   scenes: []
// });


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
    background-color: rgba(0, 0, 0, 0.2);
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