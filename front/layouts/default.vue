
import { NuxtLink } from '#build/components';
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
  
<style scoped lang="scss">
/* Mobile first */
header {
    .logo {
        width: 80px;
        margin: 0 auto;
    }
}

main {
    padding:20px 15px 50px 15px;
}


.footer {
    width: 100%;
    display: flex;
    justify-content: space-around;
}

/* Breakpoint */
@media (min-width: 768px) {}
</style>
  