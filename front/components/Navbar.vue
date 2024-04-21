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
          <span class="nav-text">Profil</span>
        </NuxtLink>
      </li>
    </ul>
  </nav>
</template>

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
        }

        .nav-text {
          text-transform: uppercase;
          letter-spacing: 1px;
          color: $beigeclair;
          font-size: 15px;
          margin-top: 8px;
        }
      }
    }
  }
}

@media (min-width:993px) {
  .navbar {
    position: relative;
    background-color: $beige;
    box-shadow: 15px 5px 15px rgba(100, 100, 100, 0.5);
    margin-bottom: 50px;

    .nav-list {
      margin: 20px;

      .nav-item {
        .nav-link {
          .nav-icon {
            display: none;
          }

          .nav-text {
            color: $black;
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
    position: static;
    box-shadow: 0 0 20px rgba(100, 100, 100, 0.5);
    .nav-list{
      justify-content: space-around;
    }
  }
}


</style>