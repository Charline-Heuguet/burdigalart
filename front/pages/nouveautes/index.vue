<template>
    <div>
        <h1>Les nouveautés</h1>
        <!-- TRI -->
        <div class="category">
            <button class="all">Tout</button>
            <button class="music">Musique</button>
            <button class="standup">Stand-Up</button>
        </div>
        <div class="card-artist">
            <ul>
                <li v-for="artist in artists" :key="artist.id">
                    {{ artist.artistName }}
                </li>
            </ul>
            <!-- <div class="card">
                <img src="/medias/artistPhotoOfficielle.jpg" alt="artist picture" />
                <div class="card-content">
                    <p>Thomas Angelvy</p>
                    <button class="standup">Stand-Up</button>
                </div>
            </div> -->
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const artists = ref([]);

// Méthode pour charger les artistes depuis l'API
// async function fetchArtists() {
//   try {
//     const response = await $fetch('https://localhost:8000/api/artists');
//     artists.value = response['hydra:member'];
//   } catch (error) {
//     console.error('Erreur lors du chargement des artistes:', error);
//   }
// }
// Appel de la méthode au chargement du composant
onMounted(fetchArtists);
</script>

<style scoped lang="scss">
@import 'assets/base/colors';

h1 {
    text-align: center;
    margin: 5px 0 15px;
}

.category {
    display: flex;
    justify-content: space-evenly;
}

button {
    min-width: 110px;
    margin: 10px;
    padding: 5px 15px;
    border-radius: 20px;
    border: 1px solid transparent;
    font-size: 15px;
}

.all {
    background-color: $gold;
}

.music {
    background-color: $mandarin;
}

.standup {
    background-color: $turquoise;
}

.card-artist {
    margin-top: 30px;

    .card {
        overflow: hidden;
        display: flex;
        margin-bottom: 15px;
        border: 1px solid black;
        border-radius: 10px;

        img {
            width: 150px;
            height: 150px;
            object-fit: cover;
        }

        .card-content {
            display: flex;
            margin: 0 auto;
            flex-direction: column;
            align-items: center;
            justify-content: space-evenly;
        }
    }
}
</style>