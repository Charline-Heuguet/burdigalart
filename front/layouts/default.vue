<template>
    <header>
        <div class="hero">
            <NuxtLink to="/">
                    <img src="/img/logo-rond.png" alt="Logo" class="logo" />
            </NuxtLink>
        </div>
        <div class="navbar-outer">
            <Navbar />
        </div>
    </header>
    <main class="gutter">
        <slot />
        <StickyCartIcon />
    </main>

    <!-- Footer qui apparaîtra lors du scroll pour le mobile first-->
    <footer class="gutter">
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
        </ul>
    </footer>
</template>

<script setup>
import StickyCartIcon from '~/components/StickyCartIcon.vue';
</script>

<style lang="scss">
@import 'assets/base/colors';

// Mobile first
header {
    .hero {
        background-image: url('/medias/banner1.webp');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
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

.footer {
    width: 100%;
    display: flex;
    justify-content: space-around;
    margin-top: 50px;
    border-top: 1px solid $darkgray;
    padding-top: 20px;
}

// Footer : qu'il reste tt le temps en bas => calcul: 100vh - la hauteur du header - la hauteur du footer
main {
    min-height: calc(100vh - 80px - 70px - 40vh);
    padding: 0 10px;

    @media (min-width:993px){
        min-height: 100vh;
    }
}

// BREAKPOINTS

@media (min-width: 1030px) {
    .gutter{
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