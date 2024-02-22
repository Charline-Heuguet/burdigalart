<template>
    <div>
        <header>
            <NuxtLink to="/">
                <img src="/img/logo-rond.png" alt="Logo" class="logo" />
            </NuxtLink>
            <Navbar />
        </header>
        <main>
            <slot />
        </main>

        <!-- Footer qui apparaîtra lors du scroll pour le mobile first-->
        <footer>
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
    </div>
</template>
  
<!-- <script setup lang="ts">
</script> -->
  
<style lang="scss">
@import 'assets/base/colors';

* {
    box-sizing: border-box;
}

body {
    background-color: $beige;
    padding: 0 10px 70px;
}

header {
    .logo {
        width: 80px;
        margin: 0 auto;
    }
}

.footer {
    width: 100%;
    display: flex;
    justify-content: space-around;
    margin-top: 50px;
}

// Footer : qu'il reste tt le temps en bas
// calcul: 100vh-la hauteur du header - la hauteur du footer
main {
    min-height: calc(100vh - 80px - 70px);
}

/* Breakpoint */
@media (min-width: 768px) {}
</style>
  