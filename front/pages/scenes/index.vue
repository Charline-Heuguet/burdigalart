<template>
    <div>
        <h1>Explorez les scènes</h1>
        <p class="h2">Découvrez des nouveaux endroits, allez à leurs évènements et trouvez votre nouvel artiste préféré</p>
        <!-- Div où les scènes ont souscrit à l'abonnement -->
        <div class="container-scene">
            <div v-for="scene in scenes" :key="scene.id" class="scene-item">
                <div v-if="scene.subscription === true">
                    <NuxtLink :to="`/scenes/${scene.slug}`">
                        <div class="img-scene">
                            <img :src="scene.banner" :alt="scene.name" class="scene-image">
                        </div>
                        <div class="text-content">
                            <h2>{{ scene.name }}</h2>
                            <p>{{ scene.address }} à {{ scene.town }}</p>
                        </div>
                    </NuxtLink>
                </div>
                <div v-if="scene.subscription === false">
                    <NuxtLink :to="`/scenes/${scene.slug}`">
                        <div class="img-scene">
                            <img :src="scene.banner" :alt="scene.name" class="scene-image">
                        </div>
                        <div class="text-content">
                            <h2>{{ scene.name }}</h2>
                            <p>{{ scene.address }} à {{ scene.town }}</p>
                        </div>
                    </NuxtLink>
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
@import 'assets/base/colors';

h1 {
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
    border-radius: 10px;
    overflow: hidden;

    .img-scene {
        width: 100%;
        height: 300px;
    }

    h2 {
        margin-bottom: 0;
    }
}

.scene-image {
    object-fit: cover;
    max-width: none;
    object-position: 50% 50%;
    width: 100%;
    height: 100%;
}

.text-content {
    position: absolute;
    bottom: 0;
    left: 0;
    padding: 10px;
    width: 100%;
    background-color: rgba(0, 0, 0, 0.2);
    backdrop-filter: blur(5px);
    text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.5);
    color: white;
    letter-spacing: 1px;
    text-align: center;
    min-height: 100px;
    display: flex;
    justify-content: center;
    flex-direction: column;
}

@media (min-width: 680px) {
    .container-scene {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    .scene-item {
        width: calc(50% - 20px);
        margin-bottom: 20px;
    }
}
</style>
