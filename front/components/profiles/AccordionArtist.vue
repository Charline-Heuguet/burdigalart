<template>
    <div v-if="artist">
        <p class="h2">En piste {{ artist.artistName }} !</p>
        <p class="h3">Ici, vous pouvez gérer votre fiche d'artiste: votre style, la description de votre spectacle, sa bannière...</p>
        <!-- Artiste / votre fiche -->
        <Accordion :item="{ title: 'Votre fiche d\'artiste', content: '' }">
            <template #content>
                <!-- S'assurer que l'artiste est chargé avant d'accéder à ses propriétés -->

                <form @submit.prevent="saveProfile">
                    <div class="form-group">
                        <label for="artistName">Votre nom d'artiste</label>
                        <input type="text" id="artistName" v-model="artist.artistName">
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
                    <ButtonSubmit>Valider</ButtonSubmit>
                </form>
            </template>
        </Accordion>

        <!-- Artiste / spectacle -->
        <Accordion :item="{ title: 'Votre show', content: '' }">
            <template #content>

                <form @submit.prevent="saveShow">
                    <div class="form-group">
                        <label for="showPhoto">Photo de votre spectacle</label>
                        <img :src="artist.showPhoto" alt="Photo du spectacle" class="show-photo">
                        <input type="file" id="showPhoto" @change="updateShowPhoto">
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

const baseUrl = 'https://localhost:8000/api';
const artistSlug = 'sophie-bodin';
const { data: artist, pending, error } = useAsyncData('artistData', () => {
    return $fetch(`${baseUrl}/artists/${artistSlug}`);
});


const saveProfile = () => {
    console.log('Profile saved:', artist.value);
};
const updateShowPhoto = (event) => {
    const file = event.target.files[0];
    if (file) {
        console.log('File selected:', file);
    }
};

const saveShow = () => {
    console.log('Show details saved:', artist.value);
};

const unsubscribe = () => {
  console.log('Unsubscribe logic here...');
};

const subscribe = () => {
  console.log('Subscribe logic here...');
};

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

.h3{
    margin: 0 0 30px;
}
.form-group {
    margin-bottom: 5px;
    padding: 12px;

    label {
        display: block;
        margin-bottom: .5rem;
    }

    input[type="text"],
    textarea {
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

.subscription{
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