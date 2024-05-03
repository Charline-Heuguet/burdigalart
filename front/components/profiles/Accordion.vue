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
  border: 1px solid $darkgray;
  border-radius: 5px;
  margin-bottom: 10px;
  overflow: hidden;
  background-color: rgba(247, 241, 235, 0.7);

  &-title {
    font-size: 18px;
    border-bottom: 1px solid $darkgray;
    padding: 10px 15px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: space-between;
    //background: rgb(67, 132, 152);
    background: linear-gradient(180deg, rgba(67, 132, 152, 1) 0%, rgba(67, 132, 152, 0.6558998599439776) 50%);

    p {
      margin: 0;
      color: $black;
      flex: 1; // Permet au titre de prendre l'espace nécessaire mais pas plus
    }
  }

  &-content {
    &.open {
      display: block;
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