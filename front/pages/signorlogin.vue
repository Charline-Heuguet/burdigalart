<template>
    <div class="home">
      <h1>Bienvenue sur notre site</h1>
      <div class="options">
        <nuxt-link to="/inscription">
          <button>Inscription</button>
        </nuxt-link>
        <nuxt-link to="/connexion">
          <button>Connexion</button>
        </nuxt-link>
      </div>
    </div>
  </template>
  
  <style scoped lang="scss">
  .home {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
  }
  
  .options button {
    margin: 10px;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
  }
  </style>
  