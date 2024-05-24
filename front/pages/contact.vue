<template>
    <h1> Formulaire de contact</h1>
    <div class="form-container">
        <form @submit.prevent="submitForm">
            <!-- Sélection du rôle de l'utilisateur -->
            <div class="form-group">
                <label for="role">Je suis:</label>
                <select id="role" v-model="form.role" @change="roleChanged">
                    <option value="">Sélectionnez votre rôle</option>
                    <option>Spectateur.trice</option>
                    <option>Artiste</option>
                    <option>Gérant.e de scène</option>
                </select>
            </div>
            <div class="form-group">
                <label for="firstname">Votre prénom et nom:</label>
                <input type="text" id="firstname" v-model="form.firstname" required>
            </div>
            <div class="form-group">
                <label for="email">Votre email:</label>
                <input type="email" id="email" v-model="form.email" required>
            </div>

            <!-- Choix de l'entité à qui envoyer un message -->
            <div class="form-group">
                <label for="targetType">Je veux envoyer un message à:</label>
                <select id="targetType" v-model="form.targetType" @change="fetchTargets">
                    <option value="">Choisir un destinataire</option>
                    <option value="artiste">Un.e artiste</option>
                    <option value="gérant de scène">Un.e gérant de scène</option>
                    <option value="administrateur">Aux administrateurs du site</option>
                </select>
            </div>

            <!-- Menu déroulant des artistes ou des scènes basé sur la sélection précédente -->
            <div class="form-group" v-if="targets.length > 0 && form.targetType !== 'administrateur'">
                <label for="targetId">{{ form.targetType === 'artiste' ? 'Artiste' : 'Scène' }}:</label>
                <select id="targetId" v-model="form.targetId">
                    <option v-for="target in targets" :key="target.id" :value="target.id">{{ target.name }}</option>
                </select>
            </div>

            <div class="form-group">
                <label for="message">Message:</label>
                <textarea id="message" v-model="form.message" required></textarea>
            </div>
            <button type="submit" class="submit-btn">Envoyer</button>
        </form>
    </div>
</template>


<script setup>
import { ref } from 'vue';
import { useRuntimeConfig } from '#app';

const runtimeConfig = useRuntimeConfig();
const apiUrl = runtimeConfig.apiUrl || runtimeConfig.public?.apiUrl;
const form = ref({
    role: '',
    firstname: '',
    email: '',
    targetType: '',
    targetId: null,
    message: ''
});

const targets = ref([]);

const roleChanged = () => {
    form.value.targetType = '';
    form.value.targetId = null;
    targets.value = [];
};

const fetchTargets = async () => {
    if (!form.value.targetType || form.value.targetType === 'administrateur') return;

    const targetType = form.value.targetType === 'artiste' ? 'artists' : 'scenes';
    const response = await fetch(`${apiUrl}${targetType}`);
    if (response.ok) {
        const data = await response.json();
        targets.value = targetType === 'artists' ? data.map(artist => ({ id: artist.id, name: artist.artistName })) : data.map(scene => ({ id: scene.id, name: scene.name }));
    } else {
        targets.value = [];
    }
};

const submitForm = async () => {
    let targetInfo = '';
    if (form.value.targetType === 'artiste' && form.value.targetId) {
        const target = targets.value.find(t => t.id === form.value.targetId);
        targetInfo = `Message pour l'artiste : ${target ? target.name : 'Non spécifié'}`;
    } else if (form.value.targetType === 'gérant de scène' && form.value.targetId) {
        const target = targets.value.find(t => t.id === form.value.targetId);
        targetInfo = `Message pour le gérant de la scène : ${target ? target.name : 'Non spécifié'}`;
    } else if (form.value.targetType === 'administrateur') {
        targetInfo = 'Message pour les administrateurs du site';
    }

    const payload = {
        role: form.value.role,
        firstname: form.value.firstname,
        email: form.value.email,
        targetType: form.value.targetType,
        targetId: form.value.targetId,
        message: form.value.message,
        targetInfo
    };

    const response = await fetch(`${apiUrl}messages/`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(payload)
    });
    // Ajoute ici un gestionnaire de réponse pour voir si tout se passe bien ou non
    if (!response.ok) {
        const errorData = await response.json();
        alert(`Error: ${errorData.message}`);
    } else {
        alert('Message sent successfully!');
        form.value = { role: '', firstname: '', email: '', targetType: '', targetId: null, message: '' };
        targets.value = [];
    }
};



</script>


<style scoped lang="scss">
@import 'assets/base/colors';

h1 {
    font-size: 28px;
    text-align: center;
    margin: 20px 0;
}
.form-container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
    background: $beigeclair;
    border-radius: 8px;

    .form-group {
        margin-bottom: 20px;

        label {
            display: block;
            margin-bottom: 5px;
            color: $black;
        }
        input{
            width: 100%;
            padding: 8px;
            border: 1px solid $darkgray;
            border-radius: 4px;
        }

        select,
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid $darkgray;
            border-radius: 4px;
        }

        textarea {
            min-height: 100px;
        }
    }

    .submit-btn {
        width: 100%;
        background-color: $mandarin;
        color: white;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
}
</style>