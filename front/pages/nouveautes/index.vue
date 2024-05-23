<template>
    <div class="container">
        <h1>Ils nous ont rejoints</h1>
        <p class="h2 mb-12">Découvrez les artistes et leurs différents univers !</p>
        <div v-if="pending">Chargement...</div>
        <div v-else-if="error">Erreur : {{ error }}</div>
        <div v-else-if="!artists || artists.length === 0">Aucun artiste à afficher</div>
        <div v-else>
            <!-- Section pour les artistes abonnés -->
            <div class="container-artist">
                <div v-for="artist in artists.filter(a => a.subscription)" :key="artist.id" class="card">

                    <div class="card-wrapper">

                        <div class="card-item">

                            <figure class="card-image">
                                <img :src="artist.officialPhoto" alt="photo officielle de l'artiste">
                            </figure>

                            <NuxtLink :to="'/artiste/' + artist.slug" class="card-content">
                                <div class="infos-card">
                                    <p class="card-title h3">{{ artist.artistName }}</p>
                                    <TagStyle class="card-tags" :style="artist.style.styleName" />
                                </div>
                                <footer class="card-footer">
                                    <div class="card-user">
                                        <figure class="card-user-img">
                                            <img :src="artist.officialPhoto" alt="photo officielle de l'artiste">
                                        </figure>
                                        <span class="card-user-name">{{ artist.description }}</span>
                                    </div>
                                </footer>
                            </NuxtLink>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Section pour les artistes non abonnés -->
            <h2>A découvrir également</h2>
            <div class="container-artist">
                <div v-for="artist in artists.filter(a => !a.subscription)" :key="artist.id" class="card">
                    <div class="card-wrapper">
                        <div class="card-item">
                            <figure class="card-image">
                                <img :src="artist.officialPhoto" alt="photo officielle de l'artiste">
                            </figure>
                            <NuxtLink :to="'/artiste/' + artist.slug" class="card-content">
                                <div class="infos-card">
                                    <p class="card-title h3">{{ artist.artistName }}</p>
                                    <TagStyle class="card-tags" :style="artist.style.styleName" />
                                </div>
                                <footer class="card-footer">
                                    <div class="card-user">
                                        <figure class="card-user-img">
                                            <img :src="artist.officialPhoto" alt="photo officielle de l'artiste">
                                        </figure>
                                        <span class="card-user-name">{{ artist.description }}</span>
                                    </div>
                                </footer>
                            </NuxtLink>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>



<script setup lang="ts">
import type { Artist } from '~/types/interfaces/artist';
import TagStyle from '~/components/ui/TagStyle.vue';

const runtimeConfig = useRuntimeConfig();
const url = runtimeConfig.apiUrl || runtimeConfig.public?.apiUrl;

const { data: artists, pending, error } = useAsyncData<Artist[]>(() => {
    return $fetch(url + 'artists');
});

</script>

<style scoped lang="scss">
@import 'assets/base/colors';

.container {
    display: flex;
    flex-direction: column;
    align-items: center;

}

.card {
    &-wrapper {
        position: relative;

        .infos-card {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }
    }

    &-item {
        aspect-ratio: 1/1;
        position: relative;
        border-radius: 32px;
        overflow: hidden;
        margin-bottom: 20px;

        &:hover {
            .card-image:after {
                background: linear-gradient(180deg,
                        rgba(0, 0, 0, 0) 10%,
                        rgba(0, 0, 0, 0.7) 50%,
                        rgba(0, 0, 0, 0.9) 100%);
            }

            .card-image img {
                transform: scale(1.03);
            }
        }

        .card-image {
            width: 100%;
            height: 100%;
            overflow: hidden;
            position: relative;

            &:after {
                content: "";
                width: 100%;
                height: 100%;
                display: block;
                position: absolute;
                top: 0;
                background: linear-gradient(180deg,
                        rgba(0, 0, 0, 0) 10%,
                        rgba(0, 0, 0, 0.7) 72%,
                        rgba(0, 0, 0, 0.9) 100%);
            }

            img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: 0.4s;
            }
        }

        .card-content {
            width: 100%;
            height: 100%;
            z-index: 1;
            position: absolute;
            top: 0;
            padding: 3%;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            row-gap: 5px;

            .card-tags {
                padding: 10px;
                background-color: $mandarin;
                border-radius: 100px;
                color: $black;
                font-size: 14px;
                font-weight: bold;
                width: max-content;
                letter-spacing: 0.6px;
                text-align: center;
            }

            .card-title {
                font-size: 24px;
                color: $beigeclair;
                font-weight: bold;
                line-height: 1.2em;
                margin-bottom: 0;
            }

            .card-footer {
                display: flex;
                align-items: center;
                column-gap: 20px;
                font-size: 14px;
                color: $beigeclair;

                .card-user {
                    display: flex;
                    align-items: center;
                    column-gap: 16px;

                    .card-user-name {
                        line-height: 1.4em;
                        overflow: hidden;
                        display: -webkit-box;
                        -webkit-box-orient: vertical;
                        -webkit-line-clamp: 3;
                    }

                    &-img {
                        width: 36px;
                        height: 36px;
                        min-width: 36px;
                        max-width: 36px;
                        overflow: hidden;
                        border-radius: 100px;

                        img {
                            width: 100%;
                            height: 100%;
                            object-fit: cover;
                        }
                    }
                }
            }
        }
    }
}

@media (min-width: 680px) {
    .container-artist {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;

        .card {
            width: calc(50% - 20px);
            margin-bottom: 20px;

            .card-content {
                padding: 20px;

                .card-title {
                    font-size: 20px;
                }

                .card-footer {
                    .card-user {
                        .card-user-name {
                            line-height: 1.2em;
                            overflow: hidden;
                            display: -webkit-box;
                            -webkit-box-orient: vertical;
                            -webkit-line-clamp: 2;
                        }
                    }
                }
            }
        }

    }
}

@media (min-width: 805px) {
    .container-artist {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;

        .card {
            width: calc(50% - 20px);
            margin-bottom: 20px;

            .card-item{
                .card-content {
                    padding: 20px;
    
                    .card-title {
                        max-width: 237px;
                        font-size: 24px;
                    }
    
                    .infos-card {
                        position: relative;
                        margin-bottom: 10px;
                        align-items: center;
                        h2{
                            margin-bottom: 0;
                        }
                        .card-tags {
                            padding: 7px;
                        }
                    }
    
                    .card-footer {
                        .card-user {
                            .card-user-name {
                                line-height: 1.4em;
                                overflow: hidden;
                                display: -webkit-box;
                                -webkit-box-orient: vertical;
                                -webkit-line-clamp: 3;
                            }
                        }
                    }
                }

            }
        }

    }
}


@media (min-width: 1024px) {
    .container-artist {

        .card {
            width: calc(33% - 20px);
            margin-bottom: 20px;
        }
    }
}

</style>
