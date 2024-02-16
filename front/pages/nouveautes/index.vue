<template>
    <div>
        <!-- <h1>Les nouveautés</h1>
        <div>
            <ul>
                <li>
                    <NuxtLink to="/nouveautes">Tout</NuxtLink>
                </li> -->
                <!-- <li>
                    <NuxtLink to="/nouveautes/musique">Musique</NuxtLink>
                </li>
                <li>
                    <NuxtLink to="/nouveautes/stand-up">Stand-Up</NuxtLink>
                </li> -->
            <!-- </ul>
        </div> -->
        <!-- Liste des artistes -->
        <!-- <section>
            <div v-for="artist in artists" :key="artist.id">
                <div class="card">
                    <div class="card-content">
                        <p>{{ artist.name }}</p>
                        <p>{{ artist.style }}</p>
                    </div>
                </div>
            </div>
        </section> -->
    </div>
</template>

<!-- <script setup lang="ts">
import { ref, onMounted } from 'vue';

const filteredArtists = ref([]);
const route = useRoute();
const category = route.params.category;

onMounted(async () => {
  // appel à l'API pour récupérer les artistes en fonction de la catégorie
  //filteredArtists.value = await fetchArtistsByCategory(category);
});
</script> -->

<style>
    .card {
        border: 1px solid #000;
        margin: 10px;
        padding: 10px;
    }
    .card-content {
        display: flex;
        justify-content: space-between;
    }
    .card-content p {
        margin: 0;
    }
    ul {
        list-style: none;
        padding: 0;
    }
    ul li {
        display: inline;
        margin-right: 10px;
    }
    ul li a {
        text-decoration: none;
    }
    ul li a:hover {
        text-decoration: underline;
    }
</style>