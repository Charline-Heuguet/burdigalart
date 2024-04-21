<template>
  <div class="accordion">
    <div class="accordion-title" @click="toggle">
      <slot name="title">{{ item.title }}</slot>
    </div>
    <div v-show="isOpen" class="accordion-content">
      <slot name="content">{{ item.content }}</slot>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps({
  item: Object // item est un objet contenant 'title' et 'content'
});

const isOpen = ref(false); // Contrôle la visibilité de la section d'accordion

const toggle = () => {
  isOpen.value = !isOpen.value; // Change l'état ouvert/fermé de l'accordion
};
</script>

  