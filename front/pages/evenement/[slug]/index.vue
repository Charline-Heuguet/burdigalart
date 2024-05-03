<template>
    <div class="event-slug">
        <div v-if="events && !error">
                <h1>{{ events.title }}</h1>
                <p class="desc">{{ events.description }}</p>
                <div class="ar16-9">
                    <img :src="events.poster" alt="">
                </div>
            <!-- Bouton "Réserver" qui amène au panier -->
            <NuxtLink to="/panier" @click="addToCart">
                <OrangeButton>Reserver</OrangeButton>
            </NuxtLink>
            <div class="infos">
                <div class="info-event">
                    <img src="/img/icon-calendar.svg" alt="">
                    <p>Le {{ formatDateTime(events.dateTime) }}h</p>
                </div>
                <div class="info-event price">
                    <!-- <img src="/img/icon-euro2.svg" alt="symbole de la monnaie euro"> -->
                    <p>{{ events.price.toFixed(2) }}€</p>
                </div>
                <div class="info-event">
                    <img src="/img/icon-marker.svg" alt="">
                    <p>{{ events.scene.address }} <br> {{ events.scene.zipcode }} {{ events.scene.town }}</p>
                </div>
            </div>

            <div v-if="events.Artist.length > 0">
                <h2>Vous les verrez sur scène :</h2>
                <div class="container-artist">
                    <div v-for="artist in events.Artist" :key="artist.slug" class="show">
                        <div class="photo ar16-9">
                            <img :src="artist.officialPhoto" alt="">
                            <div class="namestyle">
                                <p>{{ artist.artistName }}</p>
                                <p class="style">{{ artist.style.styleName }}</p>
                            </div>
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

// LES CONSTANTES
const route = useRoute(); //useRoute permet de récupérer les paramètres de l'URL
const slug = route.params.slug; // On récupère le slug de l'URL
const baseURL = 'https://localhost:8000/api/';

const formatDateTime = (dateTime) => {
    return dayjs(dateTime).format('DD/MM à HH:mm');
};

const { data: events, error } = useFetch(baseURL + 'events/' + slug);
// const store = useStore();
// const addToCart = () => {
//     const eventForCart = {
//         id: events.value.id, // Assure-toi que chaque événement a un identifiant unique
//         artist: events.value.Artist.map(a => a.artistName).join(', '),
//         show: events.value.title,
//         price: parseFloat(events.value.price.toFixed(2)),
//         quantity: 1
//     };
//     store.dispatch('addToCart', eventForCart);
// };

// COPILOT
// const addToCart = (event) => {
//     store.addToCart(event);
// };
</script>

<style scoped lang="scss">
@import 'assets/base/colors';

.event-slug{
    background-color: rgba(247, 241, 235, 0.6);
    padding: 12px;
    .desc {
        margin-bottom: 20px;
        letter-spacing: 0.01em;
        font-size: 15px;
    }
    h1 {
        font-size: 40px;
        text-align: center;
    }
    
    h2 {
        font-size: 28px;
        text-align: center;
    }
    
    img {
        width: 100%;
        height: auto;
    }
    
    
    
    .infos {
        border-bottom: $darkgray 1px solid;
        margin-top: 5px;
        margin-bottom: 12px;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    
        .info-event {
            display: flex;
            align-items: center;
            padding: 10px 0;
    
            &:last-child {
                flex: 0 0 100%;
            }
    
            p {
                font-size: 14px;
            }
    
    
            img {
                width: 25px;
                height: auto;
                margin-right: 10px;
            }
        }
        .price{
            background-color: $canard;
            text-align: center;
            border-radius: 100px;
            color: $beigeclair;
            width: 60px;
            height: 60px;
            padding: 3px;
            p{
                margin: 0 auto;
                font-size: 16px;
            }
        
        }
    }
    
    .photo {
        position: relative;
        width: 100%;
        padding-top: 56.25%; // 16:9 ratio peu importe la taille de l'écran
        margin-bottom: 30px;
    
    
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
            top: 0;
            left: 0;
            width: 100%;
            padding: 16px;
            background-color: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(5px);
            text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.5);
            color: white;
    
            .style {
                border: 1px solid $orange;
                background-color: $orange;
                border-radius: 100px;
                margin-left: 20px;
                padding: 4px 10px;
                min-width: 100px;
                text-align: center;
            }
        }
    }
}

@media (min-width: 700px) {
    .container-artist {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;

        .show {
            flex: 0 0 calc(50% - 10px);
        }
    }
    .infos {
        flex-wrap: nowrap;
        
    
        .info-event {
    
            &:last-child {
                flex: 0 0 calc(33% - 12px);
            }
    
            img {
                width: 30px;
                height: auto;
                margin-right: 10px;
            }
    
            p {
                font-size: 16px;
            }
        }
    }
    
    .photo {
        .namestyle {
            p {
                letter-spacing: 1px;
                text-transform: uppercase;
                font-weight: 600;
            }
        }
    }
}

</style>