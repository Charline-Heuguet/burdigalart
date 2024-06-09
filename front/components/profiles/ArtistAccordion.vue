<template>
    <p class="h3">En piste l'artiste!</p>
    <p>Ici, vous pouvez créer et gérer votre fiche d'artiste: le style, la description de votre spectacle, votre
        abonnement...</p>
    <div>

        <!-- CREATION D'UN ARTISTE -->
        <div v-if="canCreateArtist">
            <ButtonSubmit class="my-button" @click="showCreateForm = true">Créer votre fiche d'artiste</ButtonSubmit>
            <Accordion v-if="showCreateForm" :item="{ title: 'Créer une fiche d\'artiste', content: '' }">
                <template #content>
                    <form @submit.prevent="createArtist">
                        <div class="form-group">
                            <label for="officialPhoto">Photo officielle</label>
                            <img :src="newArtist.officialPhoto" alt="Photo officielle de l'artiste" class="official-photo">
                        </div>
                        <div class="form-group">
                            <label for="artistName">Nom d'artiste:</label>
                            <input id="artistName" v-model="newArtist.artistName" type="text">
                        </div>
                        <div class="form-group">
                            <label for="category">Dans quelle catégorie artistique vous situez-vous?</label>
                            <select id="category" v-model="newArtist.category.id">
                                <option v-for="category in categories" :key="category.id" :value="category.id">
                                    {{ category.categoryName }}
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="style">Quel est votre style de musique ?</label>
                            <select id="style" v-model="newArtist.style.id">
                                <option v-for="style in styles" :key="style.id" :value="style.id">
                                    {{ style.styleName }}
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Votre description</label>
                            <textarea id="description" v-model="newArtist.description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="instagram">Votre Instagram</label>
                            <input type="text" id="instagram" v-model="newArtist.instagram">
                        </div>
                        <div class="form-group">
                            <label for="facebook">Votre Facebook</label>
                            <input type="text" id="facebook" v-model="newArtist.facebook">
                        </div>
                        <div class="form-group">
                            <label for="linkExcerpt">Un lien d'un extrait où on pourrait vous voir</label>
                            <input type="text" id="linkExcerpt" v-model="newArtist.linkExcerpt">
                        </div>
                        <p class="h3 formh3">Et votre spectacle ?</p>
                        <div class="form-group">
                            <label for="showPhoto">Photo de votre spectacle</label>
                            <img :src="newArtist.showPhoto" alt="Photo du spectacle" class="show-photo">
                            <!-- <input type="file" id="showPhoto" @change="updateShowPhoto"> -->
                        </div>
                        <div class="form-group">
                            <label for="showTitle">Titre du spectacle</label>
                            <input type="text" id="showTitle" v-model="newArtist.showTitle">
                        </div>
                        <div class="form-group">
                            <label for="showDescription">Description du spectacle</label>
                            <textarea id="showDescription" v-model="newArtist.showDescription"></textarea>
                        </div>
                        <ButtonSubmit>Enregistrer l'artiste</ButtonSubmit>
                    </form>
                </template>
            </Accordion>
        </div>
        <!-- OU MODIFICATION DE L'ARTISTE EXISTANT -->
        <div v-if="artists.length > 0 && artist ">
            <Accordion :item="{ title: 'Fiche d\'artiste : '+ artist.artistName , content: '' }">
                <template #content>
                    <div v-for="artist in artists" :key="artist.id" class="artist-card">
                        <div class="update-artist">
                            <h3>{{ artist.artistName }}</h3>
                            <button @click="selectArtistForEdit(artist)">Modifier</button>
                        </div>
                        <div v-if="selectedArtist === artist" class="edit-form">
                            <form @submit.prevent="updateArtist">
                                <div class="form-group">
                                    <label for="officialPhoto">Photo officielle</label>
                                    <img :src="selectedArtist.officialPhoto" alt="Photo officielle de l'artiste"
                                        class="official-photo">
                                </div>
                                <div class="form-group">
                                    <label for="artistName">Votre nom d'artiste</label>
                                    <input type="text" id="artistName" v-model="selectedArtist.artistName">
                                </div>
                                <div class="form-group">
                                    <label for="category">Dans quelle catégorie artistique vous situez-vous?</label>
                                    <select id="category" v-model="selectedArtist.category.id">
                                        <option v-for="category in categories" :key="category.id" :value="category.id">
                                            {{ category.categoryName }}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="style">Quel est votre style de musique ?</label>
                                    <select id="style" v-model="selectedArtist.style.id">
                                        <option v-for="style in styles" :key="style.id" :value="style.id">
                                            {{ style.styleName }}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="description">Votre description</label>
                                    <textarea id="description" v-model="selectedArtist.description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="instagram">Votre Instagram</label>
                                    <input type="text" id="instagram" v-model="selectedArtist.instagram">
                                </div>
                                <div class="form-group">
                                    <label for="facebook">Votre Facebook</label>
                                    <input type="text" id="facebook" v-model="selectedArtist.facebook">
                                </div>
                                <div class="form-group">
                                    <label for="linkExcerpt">Un lien d'un extrait où on pourrait vous voir</label>
                                    <input type="text" id="linkExcerpt" v-model="selectedArtist.linkExcerpt">
                                </div>
                                <p class="h3 formh3">Et votre spectacle ?</p>
                                <div class="form-group">
                                    <label for="showPhoto">Photo de votre spectacle</label>
                                    <img :src="selectedArtist.showPhoto" alt="Photo du spectacle" class="show-photo">
                                    <!-- <input type="file" id="showPhoto" @change="updateShowPhoto"> -->
                                </div>
                                <div class="form-group">
                                    <label for="showTitle">Titre du spectacle</label>
                                    <input type="text" id="showTitle" v-model="selectedArtist.showTitle">
                                </div>
                                <div class="form-group">
                                    <label for="showDescription">Description du spectacle</label>
                                    <textarea id="showDescription" v-model="selectedArtist.showDescription"></textarea>
                                </div>
                                <ButtonSubmit>Sauvegarder les modifications</ButtonSubmit>
                            </form>
                        </div>
                    </div>
                </template>
            </Accordion>
        </div>
    </div>
    <!-- Les événements à venir auxquels participent l'artiste-->
    <div v-if="artist">
        <Accordion :item="{ title: 'Événements à venir ', content: '' }">
            <template #content>
                <div v-for="event in artist.events" :key="event.id" class="event-card">
                    <DateIcon :dateTime="event.dateTime" />
                    <div class="event-details">
                        <h3>{{ event.title }}</h3>
                        <p>{{ event.scene.name }}</p>
                        <p>{{ event.scene.address }}</p>
                        <p>{{ event.scene.zipcode }} {{ event.scene.town }}</p>
                    </div>
                </div>
            </template>
        </Accordion>
        <!-- Abonnement -->
        <Accordion :item="{ title: '' }">
            <template #title>
                <span>Votre abonnement</span>
                <span v-if="!artist.subscription" class="alert-icon"></span>
            </template>
            <template #content>
                <div v-if="artist.subscription" class="subscription">
                    <p>Vous êtes abonné.e</p>
                    <p>Pour annuler votre abonnement à Burdigal’Art, cliquez sur ce lien...</p>
                    <!-- Lien ou bouton pour se désabonner ici, non fonctionnel pour le moment -->
                    <button class="danger">Se désabonner</button>
                </div>
                <div v-else class="subscription">
                    <p>Vous n'êtes pas abonné.e</p>
                    <p>Pour vous abonner à Burdigal’Art, cliquez sur ce lien</p>
                    <NuxtLink to="profil/vous-abonner" class="success">S'abonner</NuxtLink>
                </div>
                <NuxtLink to="/abonnement">En savoir plus sur les abonnements</NuxtLink>
            </template>
        </Accordion>

    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { jwtDecode } from 'jwt-decode';
import Accordion from './Accordion.vue';
import DateIcon from '../ui/DateIcon.vue';
import ButtonSubmit from '../ui/ButtonSubmit.vue';

const runtimeConfig = useRuntimeConfig();
const apiUrl = runtimeConfig.public.apiUrl || runtimeConfig.apiUrl;

// initialiser les données
const artists = ref([]);// Liste des artistes (bloqué à un seul artiste par utilisateur pour l'instant)
const artist = ref(null);// Artiste connecté
const selectedArtist = ref(null);// Artiste sélectionné pour modification
const canCreateArtist = ref(true);  // l'utilisateur peut créer un artiste
const showCreateForm = ref(false); // Initialise showCreateForm comme une référence réactive

const initialNewArtistState = {
    artistName: '',
    category: { id: null },
    style: { id: null },
    description: '',
    instagram: '',
    facebook: '',
    linkExcerpt: '',
    officialPhoto: 'https://fastly.picsum.photos/id/145/4288/2848.jpg?hmac=UkhcwQUE-vRBFXzDN1trCwWigpm7MXG5Bl5Ji103QG4',
    showPhoto: 'https://fastly.picsum.photos/id/39/3456/2304.jpg?hmac=cc_VPxzydwTUbGEtpsDeo2NxCkeYQrhTLqw4TFo-dIg',
    showTitle: '',
    showDescription: ''
};
const newArtist = ref({ ...initialNewArtistState })


// Lire les catégories.
const { data: categories } = useAsyncData(() => {
    return $fetch(`${apiUrl}categories/`);
});
// Lire les styles.
const { data: styles } = useAsyncData(() => {
    return $fetch(`${apiUrl}styles/`);
});

// Lire LES artistes en fonction de l'utilisateur connecté
async function loadArtists() {
    try {
        const token = localStorage.getItem('token');
        const decoded = jwtDecode(token);
        const userId = decoded.user_id;


        artists.value = await $fetch(`${apiUrl}artists/user/byuser`, {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${token}`
            }
        });
    } catch (error) {
        console.error('Erreur lors du chargement des artistes:', error);
        artists.value = [];
    }
}

// Charger les données de l'artiste en fonction de l'utilisateur connecté
async function loadArtist() {
    try {
        const token = localStorage.getItem('token');
        const decoded = jwtDecode(token);
        const response = await $fetch(`${apiUrl}artists/user/byuser`, {
            headers: { 'Authorization': `Bearer ${token}` }
        });

        if (response && response.length > 0) {
            artist.value = response[0];  // Charge le premier artiste trouvé
            canCreateArtist.value = false;  // Empêche la création d'un nouvel artiste
        } else {
            artist.value = null;
            canCreateArtist.value = true;  // Permet la création d'un nouvel artiste
        }
    } catch (error) {
        console.error('Erreur lors du chargement des détails de l\'artiste:', error);
        artist.value = null;
        canCreateArtist.value = true;  // Permet la création d'un nouvel artiste en cas d'erreur
    }
}

// Sélectionner un artiste pour modification
function selectArtistForEdit(artist) {
    selectedArtist.value = artist;
}
// Mettre à jour un artiste
async function updateArtist() {
    if (!selectedArtist.value || !selectedArtist.value.slug) {
        alert("Aucun artiste sélectionné ou slug manquant.");
        return;
    }

    const payload = {
        artistName: selectedArtist.value.artistName,
        category: { id: selectedArtist.value.category.id },
        style: { id: selectedArtist.value.style.id },
        description: selectedArtist.value.description,
        instagram: selectedArtist.value.instagram,
        facebook: selectedArtist.value.facebook,
        linkExcerpt: selectedArtist.value.linkExcerpt,
        official_photo: selectedArtist.value.officialPhoto, 
        showPhoto: selectedArtist.value.showPhoto, 
        showTitle: selectedArtist.value.showTitle,
        showDescription: selectedArtist.value.showDescription
    };

    try {
        const response = await $fetch(`${apiUrl}artists/${selectedArtist.value.slug}`, {
            method: 'PUT',
            body: JSON.stringify(payload),
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${localStorage.getItem('token')}`
            }
        });

        alert('Artiste mis à jour avec succès!');
    } catch (error) {
        console.error('Erreur lors de la mise à jour de l\'artiste:', error);
        alert('Erreur lors de la mise à jour. Vérifiez les données et réessayez.');
    }
}

// Créer un nouvel artiste
const createArtist = async () => {
    try {
        const token = localStorage.getItem('token');
        const response = await $fetch(`${apiUrl}artists/`, {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(newArtist.value)
        });
        alert('Artiste créé avec succès!');
        
        // Réinitialiser le formulaire ou mettre à jour l'interface utilisateur ici
        // Pour réinitialiser le nouvel artiste à l'état initial et masquer le formulaire
        newArtist.value = { ...initialNewArtistState };
        showCreateForm.value = false;

        // Recharger les données de l'artiste pour mettre à jour l'interface
        await loadArtist();  // Ceci mettra à jour l'état 'artist' avec les détails du nouvel artiste

    } catch (error) {
        console.error('Erreur lors de la création de l\'artiste:', error);
        alert('Erreur lors de la création. Veuillez vérifier les données et réessayer.');
    }
};

// Exécuter les fonctions de chargement des données lors du montage du composant
onMounted(() => {
    loadArtists();
    loadArtist();
});
</script>

<style scoped lang="scss">
@import 'assets/base/colors';

.alert-icon {
    width: 10px;
    height: 10px;
    background-color: #9e0101;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    font-size: 24px;
    margin-left: 10px;
}

.h3 {
    margin: 0 0 30px;
}

.my-button {
    margin: 20px auto 20px ;
}

.formh3 {
    text-align: center;
    margin: 30px 0 20px;
}

.form-group {
    margin-bottom: 5px;
    padding: 12px;

    label {
        display: block;
        margin-bottom: .5rem;
    }

    input[type="text"],
    textarea,
    select {
        width: 100%;
        padding: .5rem;
        line-height: 1.5;
        border: 1px solid #ccc;
        border-radius: .25rem;
    }

    #showPhoto {
        margin-top: 12px;
    }

}

.show-photo {
    width: 100%;
    height: auto;
    margin-top: 10px;
}

p {
    padding: 5px;
}

.event-card {
    display: flex;
    align-items: center;
    justify-content: space-evenly;
    margin: 10px 0;
    padding: 10px;
    border-radius: 5px;

    .event-details {
        margin-left: 10px;

        p {
            padding-bottom: 0;
        }
    }
}

.subscription {
    padding: 10px;
    border-radius: 5px;

    p:first-child {
        font-weight: bold;
        margin-bottom: 10px;
        text-align: center;
    }

    button {
        padding: 10px;
        border: none;
        border-radius: 5px;
        display: block;
        margin: 0 auto;
        font-size: 18px;

        &.danger {
            background-color: red;
            font-weight: bold;
            margin-top: 12px;
        }
    }
}

a {
    display: block;
    margin: 12px 0;
    text-align: center;
}

.success {
    max-width: fit-content;
    margin: 0 auto;
    padding: 10px;
    border-radius: 5px;
    background-color: $mandarin;
    margin-top: 12px;
}


.update-artist {
    display: flex;
    justify-content: space-around;
    align-items: center;
    padding: 20px;
    border-bottom: 1px solid #ccc;

    button {
        background-color: $turquoise;
        color: $black;
        font-weight: bold;
        border: none;
        padding: 10px;
        border-radius: 5px;
        cursor: pointer;
    }
}
</style>