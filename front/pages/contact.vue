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
                    <option>Un.e artiste</option>
                    <option>Un.e gérant de scène</option>
                </select>
            </div>

            <!-- Menu déroulant des artistes ou des scènes basé sur la sélection précédente -->
            <div class="form-group" v-if="targets.length > 0 && form.targetType">
                <label for="targetId">{{ form.targetType === 'Artiste' ? 'Artiste' : 'Scène' }}:</label>
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
import { ref, watch } from 'vue';

const form = ref({
    role: '',
    firstname: '',
    lastname: '',
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
    if (!form.value.targetType) return;

    const response = await fetch(`http://localhost:8000/api/${form.value.targetType.toLowerCase()}s`);
    if (response.ok) {
        targets.value = await response.json();
    } else {
        targets.value = [];
    }
};

const submitForm = async () => {
    const payload = {
        role: form.value.role,
        firstname: form.value.firstname,
        lastname: form.value.lastname,
        email: form.value.email,
        targetId: form.value.targetId,
        message: form.value.message
    };

    const response = await fetch('http://localhost:8000/api/messages', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(payload)
    });

    if (!response.ok) {
        const errorData = await response.json();
        alert(`Error: ${errorData.message}`);
    } else {
        alert('Message sent successfully!');
        form.value = { role: '', firstname: '', lastname: '', email: '', targetType: '', targetId: null, message: '' };
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
        option{
            font-size: ;
        }

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