<template>
    <button
      class="role-pill"
      :class="{ active: isActive }"
      @click="$emit('selected', role)"
    >
      {{ role }}
    </button>
  </template>
  
  <script setup>
  const props = defineProps({
    role: String,
    isActive: Boolean
  });
  </script>
  
  <style scoped lang="scss">
  @import 'assets/base/colors';

  .role-pill {
    margin-right: 10px;
    margin-bottom: 10px;
    min-width: 120px;
    padding: 1px;
    border-radius: 30px;
    background-color: #f0f0f0;
    cursor: pointer;
    transition: background-color 0.3s, border-color 0.3s;
    color: $darkgray;
  }
  
  .role-pill.active {
    background-color: $mandarin;
    color: $black; 
  }
  </style>
  