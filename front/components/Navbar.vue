<template>
    <nav class="navbar">
        <ul class="nav-list">
            <li class="nav-item">
                <NuxtLink to="/" class="nav-link">
                    <img src="/icons/icon-home.svg" alt="Home" class="nav-icon" />
                    <span class="nav-text">Accueil</span>
                </NuxtLink>
            </li>
            <li class="nav-item">
                <NuxtLink to="/scenes" class="nav-link">
                    <img src="/icons/icon-scene.svg" alt="Scenes" class="nav-icon" />
                    <span class="nav-text">Scènes</span>
                </NuxtLink>
            </li>
            <li class="nav-item">
                <NuxtLink to="/news" class="nav-link">
                    <img src="/icons/icon-new.svg" alt="Nouveautés" class="nav-icon" />
                    <span class="nav-text">Nouveautés</span>
                </NuxtLink>
            </li>
            <li class="nav-item">
                <NuxtLink to="/profil" class="nav-link">
                    <img src="/icons/icon-profil.svg" alt="Profil" class="nav-icon" />
                    <span class="nav-text">Profil</span>
                </NuxtLink>
            </li>
        </ul>
    </nav>
</template>

<style scoped>
.navbar {
  position: fixed;
  bottom: 0;
  width: 100%;
  background: #fff;
}

.nav-list {
  list-style: none;
  display: flex;
  justify-content: space-around;
  margin: 0;
  padding: 0;
}

.nav-item {
  text-align: center;
}

.nav-link {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 5px;
}

.nav-icon {
  width: 24px;
  height: auto;
}

.nav-text {
  font-size: 0.75rem; /* ou la taille de ton choix */
}
</style>