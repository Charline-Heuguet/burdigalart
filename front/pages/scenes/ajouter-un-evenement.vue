<template>
    <h1>Proposez un évènement</h1>

    <div class="form-container">
        <form @submit.prevent="submitForm">
    
            <label for="title">Titre:</label>
            <input type="text" id="title" v-model="event.title" required>
    
            <label for="description">Description:</label>
            <textarea id="description" v-model="event.description" required></textarea>
    
            <label for="date">Date:</label>
            <input type="date" id="date" v-model="event.date" required>
    
            <label for="time">Heure:</label>
            <input type="time" id="time" v-model="event.time" required>
    
            <label for="image">Image:</label>
            <input type="file" id="image" @change="handleImageUpload">
    
            <label for="price">Prix:</label>
            <input type="number" id="price" v-model="event.price" required>
    
            <button type="submit">Ajouter</button>
        </form>
    </div>
</template>

<script>
import { ref } from 'vue';

export default {
    setup() {
        const event = ref({
            title: '',
            description: '',
            date: '',
            time: '',
            image: null,
            price: 0
        });

        const handleImageUpload = (event) => {
            const file = event.target.files[0];
            event.image = file;  // À traiter côté serveur
            // Faire quelque chose avec le fichier téléchargé, par exemple l'enregistrer sur le serveur ou le prévisualiser.
        };

        const submitForm = () => {
            // Soumettez le formulaire, par exemple en envoyant les données au serveur.
        };

        return {
            event,
            handleImageUpload,
            submitForm
        };
    }
};
</script>

<style scoped lang="scss">
@import 'assets/base/colors';

h1 {
    font-size: 28px;
    text-align: center;
}

.form-container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
    background: $beigeclair;
    border-radius: 8px;

form {
    display: flex;
    flex-direction: column;
    gap: 1rem;

    label {
        font-weight: bold;
    }

    input,
    textarea {
        width: 100%;
        padding: 8px;
        border: 1px solid $darkgray;
        border-radius: 4px;
    }

    button {
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
}
</style>