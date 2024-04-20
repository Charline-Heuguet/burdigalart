<template>
    <div>
        <h1>Explorez les scènes</h1>
        <!-- Div où les scènes ont souscrit à l'abonnement -->
        <div v-for="scene in scenes" :key="scene.id" class="scene-item">
            <div v-if="scene.subscription === true">
                <NuxtLink :to="`/scenes/${scene.slug}`">
                    <img :src="scene.banner" :alt="scene.name" class="scene-image">
                    <div class="info">
                        <h2>{{ scene.name }}</h2>
                        <p>{{ scene.address }} à {{ scene.town }}</p>
                    </div>
                </NuxtLink>
            </div>
            <div v-if="scene.subscription === false">
                <img :src="scene.banner" :alt="scene.name" class="scene-image">
                <div class="info">
                    <h2>{{ scene.name }}</h2>
                    <p>{{ scene.address }} à {{ scene.town }}</p>
                    <p></p>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import type { Scene } from '~/types/interfaces/scene';

const baseURL = 'https://localhost:8000/api/';

const { data: scenes } = useAsyncData<Scene[]>(() => {
    return $fetch(`${baseURL}scenes`);
});
</script>

<style scoped lang="scss">
h1{
    margin-top: 30px;
    margin-bottom: 50px;
    text-align: center;
}
.scene-item {
    position: relative;
    margin-right: 10px;
    margin-bottom: 50px;
    width: 100%; 
    height: auto; 
    overflow: hidden; 
}

.scene-image {
    width: 100%;
    height: 300px;
    object-fit: cover;
}

.info {
    position: absolute;
    bottom: 0;
    backdrop-filter: blur(5px);
    background-color: rgba(0, 0, 0, 0.5);
    text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.5);
    color: white;
    width: 100%;
    padding: 10px;
}

</style>
