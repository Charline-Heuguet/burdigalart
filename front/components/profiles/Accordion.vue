<template>
  <div class="accordion">
    <div class="accordion-title" @click="toggle">
      <slot name="title">{{ item.title }}</slot>
      <img src="/img/icon-arrow-next.svg" alt="une fleche qui se dirige à droite" class="icon"
        :class="{ 'open': isOpen }">
    </div>
    <div v-show="isOpen" class="accordion-content" :class="{ 'open': isOpen }">
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

<style lang="scss" scoped>
@import 'assets/base/colors';

.accordion {
  max-width: 450px;
  margin-bottom: 10px;
  overflow: hidden;
  margin: 0 auto 16px;

  &-title {
    font-size: 18px;
    padding: 10px 15px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: $beige;

    p {
      margin: 0;
      color: $black;
      flex: 1; // Permet au titre de prendre l'espace nécessaire mais pas plus
    }

    .icon {
        margin-left: auto; // Place l'icône à l'extrême droite
        width: 20px;
        transition: transform 0.3s ease;
        
    }
  }

  &-content {
    &.open {
      display: block;
      background-color: $beigeclair;
    }
  }

  .icon {
    width: 20px;
    transition: transform 0.3s ease;
  }

  .icon.open {
    transform: rotate(90deg);
  }
}
</style>