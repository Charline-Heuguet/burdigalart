<template>
  <div class="parent">
    <h2>Burdigal'Art</h2>
    <h3>Découvrez et soutenez les artistes qui façonnent la scène musicale de demain.</h3>
    <!-- Les prochains évènement -->
    <UpComingEvent />
    <!-- Les artistes à la une -->
    <TopArtists />
  </div>
</template>

<script setup>
// IMPORTS
import UpComingEvent from '~/components/UpComingEvent.vue';
import TopArtists from '~/components/TopArtists.vue';

definePageMeta({
  layout: "home",
});
</script>

<style scoped lang="scss">
@import 'assets/base/colors';

h2 {
  text-align: center;
  margin: 15px 0 25px 0;
}

h3 {
  font-size: 23px;
  margin: 40px 0 15px 0;
}

//pour le wave
.parent {
  position: relative;
}

.custom-shape-divider-bottom-1713957316 {
    position: absolute;
    bottom: 0;
    left: 0;
    overflow: hidden;
    line-height: 0;
    transform: rotate(180deg);
}

.custom-shape-divider-bottom-1713957316 svg {
    position: relative;
    display: block;
    width: calc(330% + 1.3px);
    height: 500px;
}

.custom-shape-divider-bottom-1713957316 .shape-fill {
    fill: #ee831962;
}

</style>