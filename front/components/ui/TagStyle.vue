<template>
  <div>
    <span class="style">{{ style }}</span>
  </div>
</template>

<script setup>
// DefineProps permet de définir les props d'un composant.
const props = defineProps({
  style: String,
});
</script>


<style scoped lang="scss">
@import 'assets/base/colors';

div {

  .style {
    display: inline-block;
    border-radius: 50px;
    min-width: 55px;
    text-transform: uppercase;
    font-size: 12px;
  }
}
</style>