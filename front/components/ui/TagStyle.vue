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
  margin-bottom: 20px;

  .style {
    display: inline-block;
    border-radius: 50px;
    padding: 3px 7px;
    min-width: 55px;
    color: white;
    text-transform: uppercase;
  }
}
</style>