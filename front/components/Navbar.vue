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
          color: rgb(223, 201, 201);
          font-size: 0.75rem;
          margin-top: 8px;
        }
      }
    }
  }
}
</style>