<template>
    <div class="rolesPills">
        <RolePill role="Spectateur" :isActive="currentRole === 'Spectateur'"
            @selected="role => { currentRole = role }" />
        <RolePill role="Artiste" :isActive="currentRole === 'Artiste'" @selected="role => { currentRole = role }" />
        <RolePill role="Gérant de scène" :isActive="currentRole === 'Gérant de scène'"
            @selected="role => { currentRole = role }" />
    </div>
    <ProfilBase />

</template>

<script setup>
import RolePill from '~/components/profiles/RolePill.vue';
import ProfilBase from '~/components/profiles/ProfilBase.vue';
import { ref } from 'vue';

const currentRole = ref('Spectateur'); // L'utilisateur est "Spectateur" par défaut
</script>

<style scoped lang="scss">
.rolesPills {
    display: flex;
    flex-wrap: nowrap;
    justify-content: space-around;
    overflow-x: auto;

    &::-webkit-scrollbar {
        display: none; 
    }
}
</style>