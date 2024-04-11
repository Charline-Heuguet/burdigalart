<template>
    <div v-if="showData" class="show">
        <img :src="showData.showPhoto" alt="affiche du spectacle">
        <div class="nom-show">
            <h1>{{ showData.artistName }}</h1>
            <p>Titre du show</p>
        </div>
        <div class="description">
            <NuxtLink class="line-clamp-3 " to="/">
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Recusandae, non deleniti. Quae, quos! Nobis
                    alias, rerum sed ipsam incidunt earum facere, nam cupiditate quae blanditiis id aspernatur, necessitatibus
                    eum quo?</p>
            </NuxtLink>
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
console.log(showData);

</script>
<style scoped lang="scss">
.show {
    border: 1px solid black;

    .nom-show {
        display: flex;
        justify-content: center;
        margin: 20px 0;
    }

    .description {
        margin: 20px 0;
        padding: 0 20px;
    }

}
</style>