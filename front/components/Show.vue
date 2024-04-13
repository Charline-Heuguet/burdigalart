<template>
    <div v-if="showData" class="show">
        <img :src="showData.showPhoto" alt="affiche du spectacle">
        <div class="showContent">
            <h1>{{ showData.artistName }}</h1>
            <p class="title">{{ showData.showTitle }}</p>
            <div class="description">
                <p class="line-clamp-3">{{ showData.showDescription }}</p>
            </div>
       </div>
    </div>
    <div v-else>
        Chargement...
    </div>
</template>
<script setup>
import { useRoute } from 'vue-router';

// Les imports dont on a besoin
const route = useRoute(); //useRoute permet de récupérer les paramètres de l'URL
const slug = route.params.slug; // On récupère le slug de l'URL
const baseURL = 'https://localhost:8000/api/';

// Appel de l'API
const { data: showData } = useFetch(baseURL + 'artists/' + slug);

</script>
<style scoped lang="scss">
h1 {
    font-size: 45px;
}

.show {
    border: 1px solid black;

    .showContent {
        padding: 8px;

        .title{
            font-size: 20px;
            font-weight: 500;
        }
        .description {
            margin: 20px 10px;
            font-style: italic ;
        }
    }

}
</style>