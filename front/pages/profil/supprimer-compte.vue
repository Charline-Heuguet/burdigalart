<template>
    <div class="delete">
        <h2>Supprimer mon compte</h2>
        <p>Attention, cette action est irréversible.</p>
        <p>Votre compte sera d'abord désactivé puis toutes vos données seront supprimées au bout de 30 jours.</p>
        <p>Si vous rencontrez un quelconque problème, merci de nous contacter.</p>
        <div v-if="errorMessage" class="error-message">{{ errorMessage }}</div>
        <div class="button-delete">
            <button @click="handleDelete">Supprimer mon compte</button>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import {jwtDecode} from 'jwt-decode';
import { useAuthStore } from '~/stores/auth'; 

const authStore = useAuthStore();
const errorMessage = ref('');

// Décodage du JWT pour obtenir l'ID de l'utilisateur
const token = localStorage.getItem('token');
let userId = null;
if (token) {
  try {
    const decoded = jwtDecode(token);
    userId = decoded.user_id;
  } catch (error) {
    console.error('Erreur de décodage du JWT:', error);
    errorMessage.value = 'Erreur lors du traitement de vos informations d\'utilisateur.';
  }
}

const handleDelete = async () => {
  console.log('Suppression du compte');
  if (!userId) {
    errorMessage.value = 'Erreur : ID utilisateur non trouvé.';
    return;
  }

  try {
    await authStore.deleteUser(userId);
  } catch (error) {
    errorMessage.value = 'Une erreur est survenue lors de la suppression du compte.';
    console.error('Erreur lors de la suppression:', error);
  }
};

</script>


<style lang="scss" scoped>
.delete {
    max-width: 600px;
    margin: 30px auto 0;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
    background-color: rgba(247, 241, 235, 0.7);
    border-radius: 8px;
    p {
        margin-bottom: 20px;
    }
    .button-delete {
        display: flex;
        justify-content: center;
    }

    button {
        display: flex;
        justify-content: center;
        background-color: red;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 20px;
    }

}
</style>