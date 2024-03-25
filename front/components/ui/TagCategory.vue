<template>
    <div>
      <span class="categorie">{{ category }}</span>
    </div>
  </template>
  
  <script setup>
// DefineProps permet de définir les props d'un composant.

  const props = defineProps({
    category: String // Ici, on définit la prop category de type String.
  });
  </script>
  

<style scoped lang="scss">
@import 'assets/base/colors';

div {
    .categorie {
            border-radius: 50px;
            padding: 3px 7px; 
            margin-top: 25px;
            width: fit-content;
            font-size: 11px;
            background: $darkgray;
            color: white;
            text-transform: uppercase;
    }
}
</style>
