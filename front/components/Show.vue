<template>
    <div v-if="showData" class="show">
        <img :src="showData.showPhoto" alt="affiche du spectacle">
        <div class="showContent">
            <p class="title">{{ showData.showTitle }}</p>
            <div class="description">
                <p>{{ showData.showDescription }}</p>
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
@import 'assets/base/colors';

h1 {
    font-size: 45px;
}

.show {
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 0 30px 0 rgba(0, 0, 0, 0.3);
    background-color: $beigeclair;
    margin-bottom: 50px;

    .showContent {
        padding: 8px;

        .title {
            font-size: 20px;
            font-weight: 500;
        }

        .description {
            margin: 20px 10px;
            font-style: italic;
        }
    }

}

@media (min-width: 679px){
    .show {
        display: flex;
        flex-direction: row;
        align-items: center;

        .showContent{
            margin-left: 15px;
        }

        img {
            width: 300px;
        }
    }
    
}
</style>