<template>
    <div class="accordion" @click="toggle">
      <div class="accordion-title">
        <slot name="title">{{ title }}</slot>
      </div>
      <div v-show="isOpen" class="accordion-content">
        <slot name="content"></slot>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  
  const props = defineProps({
    title: String
  });
  
  const isOpen = ref(false);
  
  const toggle = () => {
    isOpen.value = !isOpen.value;
  };
  </script>
  