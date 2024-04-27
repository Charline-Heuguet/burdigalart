<!-- page d'une seule scene -->
<template>
    <div v-if="scene && !error">
        <img src="" alt="">
        <h1>{{ scene.name }}</h1>
        <div class="infos">
            <div class="info-scene">
                <img src="/img/icon-pointer2.svg" alt="pointeur">
                <p>{{ scene.address }} {{ scene.zipcode }} {{ scene.town }}
                </p>
            </div>
            <div class="info-scene">
                <img src="/img/icon-tel2.svg" alt="combiné de téléphone">
                <p>{{ scene.phoneNumber }}</p>
            </div>
        </div>
        <div class="info-contact">
            <img src="/img/icon-envelop.svg" alt="enveloppe">
            <div>
                <NuxtLink to="/contact">
                    <p>Contactez-nous</p>
                </NuxtLink>

            </div>
        </div>
        <h2>Nos évènements :</h2>
        <!-- Attention au dynamisme: uniquement le nom de la scène -->
        <Event />
    </div>
</template>

<script setup>
import dayjs from 'dayjs';  

const route = useRoute(); //useRoute permet de récupérer les paramètres de l'URL
const slug = route.params.slug; // On récupère le slug de l'URL

const baseURL = 'https://localhost:8000/api/';

const formatDateTime = (dateTime) => {
    return dayjs(dateTime).format('DD/MM à HH:mm');
};

const { data: scene, error } = useFetch(baseURL + 'scenes/' + slug);
console.log(scene);
</script>

<style scoped lang="scss">
@import 'assets/base/colors';

h1{
    text-align: center;
}

.infos{
    border-bottom: 1px solid $darkgray;
    margin-bottom: 12px;
}

.info-scene,
.info-contact {
    display: flex;
    align-items: center;
    margin-bottom: 20px;

    img {
        width: 25px;
        height: auto;
        margin-right: 10px;
    }
}
</style>
