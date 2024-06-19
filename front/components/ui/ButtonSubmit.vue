<template>
    <button :type="type">
        <slot></slot>
    </button>
</template>

<script setup>
import { defineProps } from 'vue';

// Définition des props avec une valeur par défaut pour 'type'
const props = defineProps({
  type: {
    type: String,
    default: 'submit' // 'submit' est la valeur par défaut
  }
});
</script>

<style scoped lang="scss">
@import 'assets/base/colors';

button {
    background-color: $mandarin;
    color: $beigeclair;
    padding: 10px;
    border-radius: 5px;
    font-size: 20px;
    margin: 20px 0;
    cursor: pointer;
    display: block;
    margin: 0 auto;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 1px;
    border: 2px solid darken($mandarin, 5%);
    text-shadow: 2px 2px 0px darken($mandarin, 15%);
}
</style>