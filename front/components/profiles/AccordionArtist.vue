<template>
    <div v-if="artist">
        <p class="h3">En piste l'artiste!</p>
        <p>Ici, vous pouvez gérer votre fiche d'artiste: votre style, la description de votre spectacle, sa
            bannière...</p>
        <!-- Artiste / votre fiche -->
        <Accordion :item="{ title: 'Votre fiche d\'artiste', content: '' }">
            <template #content>
                <!-- S'assurer que l'artiste est chargé avant d'accéder à ses propriétés -->

                <form @submit.prevent="saveProfile">
                    <p class="h3 formh3">Présentez-vous :</p>
                    <div class="form-group">
                        <label for="officialPhoto">Photo officielle</label>
                        <img :src="artist.officialPhoto" alt="Photo officielle de l'artiste" class="official-photo">
                    </div>
                    <div class="form-group">
                        <label for="artistName">Votre nom d'artiste</label>
                        <input type="text" id="artistName" v-model="artist.artistName">
                    </div>
                    <div class="form-group">
                        <label for="category">Dans quelle catégorie artistique vous situez-vous?</label>
                        <select id="category" v-model="artist.category.id">
                            <option v-for="category in categories" :key="category.id" :value="category.id">
                                {{ category.categoryName }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="style">Quel est votre style de musique ?</label>
                        <select id="style" v-model="artist.style.id">
                            <option v-for="style in styles" :key="style.id" :value="style.id">
                                {{ style.styleName }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Votre description</label>
                        <textarea id="description" v-model="artist.description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="instagram">Votre Instagram</label>
                        <input type="text" id="instagram" v-model="artist.instagram">
                    </div>
                    <div class="form-group">
                        <label for="facebook">Votre Facebook</label>
                        <input type="text" id="facebook" v-model="artist.facebook">
                    </div>
                    <div class="form-group">
                        <label for="linkExcerpt">Un lien d'un extrait où on pourrait vous voir</label>
                        <input type="text" id="linkExcerpt" v-model="artist.linkExcerpt">
                    </div>
                    <p class="h3 formh3">Et votre spectacle ?</p>
                    <div class="form-group">
                        <label for="showPhoto">Photo de votre spectacle</label>
                        <img :src="artist.showPhoto" alt="Photo du spectacle" class="show-photo">
                        <!-- <input type="file" id="showPhoto" @change="updateShowPhoto"> -->
                    </div>
                    <div class="form-group">
                        <label for="showTitle">Titre du spectacle</label>
                        <input type="text" id="showTitle" v-model="artist.showTitle">
                    </div>
                    <div class="form-group">
                        <label for="showDescription">Description du spectacle</label>
                        <textarea id="showDescription" v-model="artist.showDescription"></textarea>
                    </div>
                    <ButtonSubmit>Valider</ButtonSubmit>
                </form>
            </template>
        </Accordion>

        <!-- Artiste / à venir -->
        <Accordion :item="{ title: 'Vos prochains événements', content: '' }">
            <template #content>
                <div v-for="event in artist.events" :key="event.title" class="event-card">
                    <DateIcon :dateTime="event.dateTime" />
                    <div class="event-details">
                        <h3>{{ event.title }}</h3>
                        <p>{{ event.scene.name }}, </p>
                        <p>{{ event.scene.address }}, </p>
                        <p>{{ event.scene.zipcode }} {{ event.scene.town }}</p>
                    </div>
                </div>
            </template>
        </Accordion>

        <!-- Artiste / Abonnement -->
        <Accordion :item="{ title: '' }">
            <template #title>
                <span>Votre abonnement</span>
                <span v-if="!artist.subscription" class="alert-icon"></span>
            </template>
            <template #content>
                <div v-if="artist.subscription" class="subscription">
                    <p>Vous êtes abonné.e</p>
                    <p>Pour annuler votre abonnement à Burdigal’Art, cliquez sur ce lien...</p>
                    <button @click="unsubscribe" class="danger">Se désabonner</button>
                </div>
                <div v-else class="subscription">
                    <p>Vous n'êtes pas abonné.e</p>
                    <p>Pour vous abonner à Burdigal’Art, cliquez sur ce lien...</p>
                    <button @click="subscribe" class="success">S'abonner</button>
                </div>
                <NuxtLink to="/abonnement">En savoir plus sur les abonnements</NuxtLink>
            </template>
        </Accordion>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import Accordion from './Accordion.vue';
import DateIcon from '../ui/DateIcon.vue';
import ButtonSubmit from '../ui/ButtonSubmit.vue';
import { useAsyncData } from 'nuxt/app';
import { jwtDecode } from "jwt-decode";

const runtimeConfig = useRuntimeConfig();
const apiUrl = runtimeConfig.public.apiUrl || runtimeConfig.apiUrl;

const artist = ref(null);
const userRoles = ref([]);
const userId = ref(null);

function initializeArtistModel() {
    return {
        artistName: '',
        category: { categoryName: '' },
        style: { styleName: '' },
        description: '',
        instagram: '',
        facebook: '',
        linkExcerpt: '',
        officialPhoto: 'https://fastly.picsum.photos/id/91/3504/2336.jpg?hmac=tK6z7RReLgUlCuf4flDKeg57o6CUAbgklgLsGL0UowU', // URL par défaut pour la photo officielle
        showPhoto: 'https://fastly.picsum.photos/id/158/4836/3224.jpg?hmac=Gu_3j3HxZgR74iw1sV0wcwlnSZSeCi7zDWLcjblOp_c', // URL par défaut pour la photo du spectacle
        showTitle: '',
        showDescription: ''
    };
}

// Lire les catégories.
const { data: categories } = useAsyncData(() => {
    return $fetch(`${apiUrl}categories/`);
});
// Lire les styles.
const { data: styles } = useAsyncData(() => {
    return $fetch(`${apiUrl}styles`);
});

// Décoder le token stocké pour obtenir les informations de l'utilisateur
function decodeToken() {
    const token = localStorage.getItem('token');
    if (token) {
        const decoded = jwtDecode(token);
        userRoles.value = decoded.roles || [];
        userId.value = decoded.user_id;
        return decoded;
    }
    return null;
}

onMounted(() => {
    const userInfo = decodeToken();
    if (userInfo && userRoles.value.includes('ROLE_ARTISTE')) {
        $fetch(`${apiUrl}artists/user/${userId.value}`).then((response) => {
            artist.value = response;
        }).catch(() => {
            artist.value = initializeArtistModel();
        });
    } else {
        artist.value = initializeArtistModel();
    }
});

async function saveProfile() {
    const payload = {
        artistName: artist.value.artistName,
        category: artist.value.category.id, // ID de la catégorie
        style: artist.value.style.id, // ID du style
        description: artist.value.description,
        instagram: artist.value.instagram,
        facebook: artist.value.facebook,
        linkExcerpt: artist.value.linkExcerpt,
        official_photo: artist.value.officialPhoto,
        showPhoto: artist.value.showPhoto,
        showTitle: artist.value.showTitle,
        showDescription: artist.value.showDescription,
        user_id: userId.value
    };

    try {
        const response = await $fetch(`${apiUrl}artists/`, {
            method: 'POST',
            body: JSON.stringify(payload),
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${localStorage.getItem('token')}`
            }
        });

        // Réponse du serveur
        alert('Profil sauvegardé avec succès!');
        console.log('Réponse:', response);
    } catch (error) {
        console.error('Erreur lors de la sauvegarde:', error);
        alert('Erreur lors de la sauvegarde du profil. Vérifiez les données et réessayez.');
    }
}

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
            margin-top: 12px;
        }

        &.success {
            background-color: $mandarin;
            margin-top: 12px;
        }
    }
}

a {
    display: block;
    margin: 12px 0;
    text-align: center;
}
</style>