<template>
    <div v-if="isVisible" class="popup">
        <div class="popup-content">
            <h2>Avertissement</h2>
            <p>Ce site est un <span>projet étudiant</span>.</p> 
            <p>Les données présentées sont partiellement réelles et utilisées uniquement à <span>des fins de démonstration</span>.</p>
            <p>Merci de ne pas saisir de données sensibles.</p>
            <button @click="closePopup">Compris</button>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const isVisible = ref(true);

function closePopup() {
    isVisible.value = false;
}
</script>

<style scoped lang="scss">
@import 'assets/base/colors';
.popup {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 999999999999999999;

    h2 {
        margin-top: 0;
        text-decoration: underline;

    }

    .popup-content {
        background: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        text-align: center;

        span{
            font-weight: bold;
        }

        button {
            background-color: $mandarin;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            padding: 8px 16px;
            margin-top: 20px;
        }
    }
}
</style>