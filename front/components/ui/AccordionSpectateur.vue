<template>
    <div class="accordion">
        <div v-for="(item, index) in accordionItems" :key="index" class="accordion-item" :class="{ active: activeIndex === index }">
            <div class="accordion-title" @click="toggleContent(index)">
                <h3>{{ item.title }}</h3>
            </div>
            <div class="accordion-content">
                <p>{{ item.content }}</p>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';

const accordionItems = ref([
    { title: 'Titre 1', content: 'Contenu 1' },
    { title: 'Titre 2', content: 'Contenu 2' },
    { title: 'Titre 3', content: 'Contenu 3' }
]);

const activeIndex = ref(null);

const toggleContent = (index) => {
    activeIndex.value = activeIndex.value === index ? null : index;
};
</script>

<style scoped lang="scss">
.accordion-item {
    .accordion-content {
        display: none;
    }
    &.active {
        .accordion-content {
            display: block;
        }
    }
}
</style>
