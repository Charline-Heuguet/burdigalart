<template>
    <header>
        <div class="hero">
            <NuxtLink to="/">
                <h1><span class="sr-only">Burdigal'Art</span>
                    <img src="/img/logo-rond.png" alt="Logo" class="logo" />
                </h1>
            </NuxtLink>
        </div>
        <div class="navbar-outer">
            <Navbar />
        </div>
    </header>
    <main class="gutter">
        <StudentProjectWarning />
        <StickyCartIcon />
        <slot />
    </main>

    <!-- Footer qui apparaîtra lors du scroll pour le mobile first-->
    <footer>
        <div class="gutter">
            <ul class="footer">
                <li>
                    <NuxtLink to="/equipe">L'équipe</NuxtLink>
                </li>
                <li>
                    <NuxtLink to="/contact">Contact</NuxtLink>
                </li>
                <li>
                    <NuxtLink to="/mentions-legales">Mentions légales</NuxtLink>
                </li>
                <li>
                    <NuxtLink to="/cgu">CGU</NuxtLink>
                </li>
                <li>
                    <NuxtLink to="/cgv">CGV</NuxtLink>
                </li>
            </ul>
            <div class="social-icons">
                <a href="https://www.facebook.com" target="_blank">
                    <img src="/img/icon-fb.svg" alt="Facebook" />
                </a>
                <a href="https://www.instagram.com" target="_blank">
                    <img src="/img/icon-insta.svg" alt="Instagram" />
                </a>
                <a href="https://www.twitter.com" target="_blank">
                    <img src="/img/icon-lkdn.svg" alt="linkedin" />
                </a>
            </div>
        </div>
    </footer>

</template>
<script setup>
import StickyCartIcon from '~/components/StickyCartIcon.vue';
import StudentProjectWarning from '~/components/StudentProjectWarning.vue';
import { onMounted } from 'vue';
import { useAuthStore } from '~/stores/auth';

const authStore = useAuthStore();

onMounted(() => {
  authStore.fetchUserFromToken();
});


</script>

<style scoped lang="scss">
@import 'assets/base/colors';
// Mobile first
header {
    .hero {
        background-image: url('/medias/banner1.webp');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        aspect-ratio: 16/9;
        width: 100%;
        height: 400px;
        padding: 20px 0;
        text-align: center;
    }

    .logo {
        width: 115px;
        margin: 0 auto;
    }
}

.gutter {
    max-width: 1030px;
    margin: 0 auto;
}

footer {
    background-color: $black;
    padding-bottom: 25px;
    .footer {
        width: 100%;
        display: flex;
        flex-direction: row; // Change la direction pour une disposition verticale
        align-items: center; // Centre les éléments horizontalement
        justify-content: space-around;
        margin-top: 50px;
        border-top: 1px solid $darkgray;
        padding-top: 20px;

        a{
            color: $beigeclair;
            text-decoration: none;
        }
    }

    .social-icons {
        display: flex;
        justify-content: center;
        margin-top: 20px; // Espace entre les icônes et les liens

        a {
            display: flex;
            margin: 0 10px; // Espacement horizontal entre les icônes
        }

        img {
            width: 20px;
        }
    }
}

// Footer : qu'il reste tt le temps en bas => calcul: 100vh-la hauteur du header - la hauteur du footer
main {
    min-height: calc(100vh - 80px - 70px - 40vh);
    padding: 0 10px;
}

// BREAKPOINTS

@media (min-width: 1030px) {
    .gutter {
        max-width: 1140px;
    }
}


@media (min-width: 1200px) {
    .container {
        max-width: none; // Permet au container de prendre toute la largeur

        header .hero {
            background-size: cover;
            background-position: center;
        }
    }
}
</style>