<template>
    <div class="info-icon" @mouseover="show = true" @mouseleave="show = false">
      <img src="/img/icon-info.svg" alt="la lettre i dans un cercle" class="tooltip-icon"/>
      <div v-if="show" class="tooltip">
        <slot></slot>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  
  const show = ref(false);
  </script>
  
  <style scoped>
  .info-icon {
    position: relative;
    display: inline-block;
    cursor: pointer;
  }
  
  .tooltip-icon {
    width: 20px;
    margin-left: 10px;
  }
  
  .tooltip {
    position: absolute;
    width: 200px;
    background-color: white;
    color: black;
    text-align: center;
    border-radius: 6px;
    padding: 5px 10px;
    border: 1px solid #ccc;
    /* Adjust the position as needed */
    bottom: 100%;
    left: 50%;
    transform: translateX(-50%);
    visibility: hidden;
    z-index: 100;
  }
  
  .info-icon:hover .tooltip {
    visibility: visible;
  }
  </style>
  