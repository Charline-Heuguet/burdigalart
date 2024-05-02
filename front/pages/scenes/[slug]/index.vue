<!-- page d'une seule scene -->
<template>
    <div v-if="scene && !error">
        <img src="" alt="">
        <h1>{{ scene.name }}</h1>
        <h2>À l'affiche:</h2>
            <Event />
        <h3>Où nous trouver ?</h3>
        <div class="infos">
            <div class="info-scene">
                <img src="/img/icon-pointer2.svg" alt="pointeur">
                <div class="scene-address">
                    <p>{{ scene.address }}</p> 
                    <p>{{ scene.zipcode }} {{ scene.town }}</p>
                </div>
            </div>
            <div class="info-scene">
                <img src="/img/icon-tel2.svg" alt="combiné de téléphone">
                <p>{{ scene.phoneNumber }}</p>
            </div>
        </div>
        <NuxtLink to="/contact">
            <OrangeButton>Contactez-nous</OrangeButton>
        </NuxtLink> 
    </div>
</template>

<script setup>
import dayjs from 'dayjs';  
import OrangeButton from '~/components/ui/OrangeButton.vue';

const route = useRoute(); //useRoute permet de récupérer les paramètres de l'URL
const slug = route.params.slug; // On récupère le slug de l'URL

const baseURL = 'https://localhost:8000/api/';

const formatDateTime = (dateTime) => {
    return dayjs(dateTime).format('DD/MM à HH:mm');
};

const { data: scene, error } = useAsyncData('scene', async () => {
  const response = await fetch(baseURL + 'scenes/' + slug);
  if (!response.ok) {
    throw new Error('Network response was not ok');
  }
  return response.json();
});
console.log(scene);

// appel api pour recuperer le slug de l'évènement
// const { data: event, errorEvent } = useFetch(baseURL + 'scenes/' + slug );
</script>

<style scoped lang="scss">
@import 'assets/base/colors';

h1{
    text-align: center;
}

h3{
    margin: 20px 0;
}
.infos{
    display: flex;
    justify-content: space-between;
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
