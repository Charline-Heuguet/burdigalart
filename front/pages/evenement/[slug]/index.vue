<template>
    <div class="event-slug">
        <div v-if="events && !error">
            <div class="poster-title">
                <img :src="events.poster" alt="" class="ar16-9">
                <div>
                    <h1>{{ events.title }}</h1>
                    <p class="desc h2">{{ events.description }}</p>
                <!-- Bouton "Réserver" qui amène au panier -->
                <NuxtLink to="/panier" @click="addToCart">
                    <OrangeButton class="button">Reserver</OrangeButton>
                </NuxtLink>
                </div>
            </div>

            <!-- Date / adresse et prix -->
            <div class="infos">
                <div class="info-event">
                    <img src="/img/icon-calendar.svg" alt="">
                    <p>Le {{ formatDateTime(events.dateTime) }}h</p>
                </div>
                <div class="info-event">
                    <img src="/img/icon-marker.svg" alt="">
                    <p>{{ events.scene.address }} <br> {{ events.scene.zipcode }} {{ events.scene.town }}</p>
                </div>
                <div class="info-event price">
                    <p>{{ events.price.toFixed(2) }}€</p>
                </div>
            </div>

            <!-- Artistes participants-->
            <div v-if="events.Artist.length > 0">
                <div class="container-artist">
                    <h2>Ils participent à cet événement:</h2>
                    <div class="card-artist">
                        <div v-for="artist in events.Artist" :key="artist.slug" class="show">
                            <NuxtLink :to="'/artiste/' + artist.slug">
                                <div class="photo ar16-9">
                                    <img :src="artist.officialPhoto" alt="">
                                    <div class="namestyle">
                                        <p>{{ artist.artistName }}</p>
                                        <TagStyle class="card-tags" :style="artist.style.styleName" />
                                    </div>
                                </div>
                            </NuxtLink>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script setup>
import dayjs from 'dayjs';
import OrangeButton from '~/components/ui/OrangeButton.vue';
import { useCartStore } from '~/stores/useCartStore';
import TagStyle from '~/components/ui/TagStyle.vue';

const runtimeConfig = useRuntimeConfig();
const url = runtimeConfig.apiUrl || runtimeConfig.public?.apiUrl;

// Pour récupérer le slug de l'URL
const route = useRoute(); //useRoute permet de récupérer les paramètres de l'URL
const slug = route.params.slug; // On récupère le slug de l'URL

const formatDateTime = (dateTime) => {
    return dayjs(dateTime).format('DD/MM à HH:mm');
};

// Appel API
const { data: events, error } = useAsyncData(() => {
    return $fetch(url + 'events/' + slug);
});


// Store
const cartStore = useCartStore();

const addToCart = () => {
    console.log("Adding to cart", {
        id: events.value.id,
        artist: events.value.Artist.map(a => a.artistName).join(', '),
        show: events.value.title,
        price: parseFloat(events.value.price.toFixed(2))
    });
    cartStore.addItem({
        id: events.value.id,
        artist: events.value.Artist.map(a => a.artistName).join(', '),
        show: events.value.title,
        price: parseFloat(events.value.price.toFixed(2))
    });
};

const { toTitleCase } = useUtilities();
useHead({
    title: toTitleCase(route.params.slug)
});
</script>

<style scoped lang="scss">
@import 'assets/base/colors';

.event-slug {
    padding: 12px;
    margin-top: 40px;

    .desc {
        margin-bottom: 40px;
        letter-spacing: 0.02em;
        font-size: 18px;
        font-weight: 400;
    }

    .poster-title {

        img {
            border-radius: 10px;
        }
    }

    .infos {
        margin-top: 5px;
        margin-bottom: 12px;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;

        .info-event {
            display: flex;
            align-items: center;
            padding: 10px 0;


            p {
                font-size: 14px;
            }

            // Icones
            img {
                width: 25px;
                height: auto;
                margin-right: 10px;
            }
        }

        .price {
            background-color: $canard;
            text-align: center;
            border-radius: 100px;
            color: $beigeclair;
            width: 60px;
            height: 60px;
            padding: 3px;

            p {
                margin: 0 auto;
                font-size: 16px;
            }

        }
    }

    .photo {
        margin-bottom: 30px;
        border-radius: 10px;


        img {
            width: 100%; // prend la largeur totale du parent
            height: 100%; // prend la hauteur totale du parent
            object-fit: cover; // assure que l'image couvre la dimension du parent sans perdre son ratio
            object-position: center; // centre l'image dans le cadre
            position: absolute;
            top: 0;
        }

        .namestyle {
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: space-between;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 16px;
            background-color: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(5px);
            text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.5);
            color: white;
            text-transform: uppercase;

        }
    }

    .container-artist {
        border-top: $darkgray 1px solid;

        h2 {
            margin-top: 20px;
            margin-bottom: 20px;
        }
    }

}

@media (min-width: 700px) {
    .card-artist {
        display: flex;
        justify-content: space-between;

        .show {
            display: block;
            flex: 0 1 calc(50% - 20px);
        }
    }
}

@media (min-width: 820px) {
    .event-slug {
        .button {
            width: 300px;
            margin: 20px auto;
        }

        .poster-title {
            img {
                width: 500px;
                height: auto;
                margin: 0 auto;
            }
        }
    }
}

@media (min-width: 1024px) {
    .event-slug {
        h1 {
            margin-top: 10px;
        }

        .poster-title {
            display: flex;
            justify-content: space-between;

            img {
                width: 50%;
                height: auto;
            }

            div {
                margin-left: 30px;
            }
        }

        .infos {
            margin-top: 40px;
        }

    }
}
</style>