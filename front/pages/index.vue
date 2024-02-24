<template>
  <div>
    <h1> Burdigal'Art</h1>
    <h2>"Découvrez, suivez, et soutenez les artistes qui façonnent la scène musicale de demain.</h2>

    <div class="artist-list">
      <div v-for="artist in artists" :key="artist.id">
        <nuxt-link :to="`/artist/${artist.id}`">
          <img :src="artist.picture" :alt="artist.name" />
          <h3>{{ artist.name }}</h3>
        </nuxt-link>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';



</script>

<style scoped lang="scss">
h1 {
  text-align: center;
  margin: 5px 0;
}

h2 {
  font-style: italic;
  text-align: center;
  margin: 15px 0 5px 0;
}
</style>