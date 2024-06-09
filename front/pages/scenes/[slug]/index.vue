<!-- page d'une seule scene -->
<template>
    <div v-if="scene && !error">
        <h1>{{ scene.name }}</h1>
        <div class="img-info">
            <div class="img-scene"><img :src="scene.banner" alt="choisie par la scene"></div>
            <div class="find-us">
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
            </div>
        <NuxtLink to="/contact" class="orange-button">
            <OrangeButton >Contactez-nous</OrangeButton>
        </NuxtLink>
        </div>
        
        <Event />

    </div>
</template>

<script setup>
import OrangeButton from '~/components/ui/OrangeButton.vue';
import Event from '~/components/Event.vue';
const runtimeConfig = useRuntimeConfig();
const url = runtimeConfig.apiUrl || runtimeConfig.public?.apiUrl;

const route = useRoute(); //useRoute permet de récupérer les paramètres de l'URL
const slug = route.params.slug; // On récupère le slug de l'URL

const { data: scene, error } = useAsyncData('scene', async () => {
    const response = await fetch(url + 'scenes/' + slug);
    if (!response.ok) {
        throw new Error('Network response was not ok');
    }
    return response.json();
});

const { toTitleCase } = useUtilities();
useHead({
    title: toTitleCase(route.params.slug)
});

</script>

<style scoped lang="scss">
@import 'assets/base/colors';

h1 {
    text-align: center;
}
h2{
    margin: 1.5em 0;
}
h3 {
    margin-top: 30px;
}

.img-info {
    display: flex;
    flex-direction: column;
    margin: 20px 0;

    h3{
        text-decoration: underline;
        text-underline-offset: 5px;
        text-decoration-thickness: 1px;
    }

    .img-scene {
        max-height: 300px;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 10px;
    }

        img {
            width: 100%;
            height: 100%;
        }
    .infos {
        margin: 20px 0 0;
    }
}

.info-scene,.info-contact {
    display: flex;
    align-items: center;
    margin-bottom: 20px;

    img {
        width: 25px;
        height: auto;
        margin-right: 20px;
    }
}

@media (min-width: 820px) {
    .img-info {
        flex-direction: row;
        align-items: flex-start;
        position: relative;

        .img-scene {
            max-width: 50%;
            margin-right: 20px;
        }

        .find-us {
            margin-left: 30px;
        }
    }
}
@media (min-width: 1024px) {
    .img-info {
        .img-scene {
            max-width: 60%;
        }
    }
    .orange-button{
        position: absolute;
        bottom: 0;
        right: calc(50% - 400px);
        margin: 0;
    }
}
</style>
