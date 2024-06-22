<template>
  <form @submit.prevent="submitEvent">
    <div>
      <label for="title">Titre:</label>
      <input id="title" v-model="event.title" type="text" required>
    </div>
    <div>
      <label for="description">Description:</label>
      <textarea id="description" v-model="event.description"></textarea>
    </div>
    <div>
      <label for="dateTime">Date et Heure:</label>
      <input id="dateTime" v-model="event.dateTime" type="datetime-local" required>
    </div>
    <div>
      <label for="poster">Affiche URL:</label>
      <input id="poster" v-model="event.poster" type="text" required>
    </div>
    <div>
      <label for="price">Prix:</label>
      <input id="price" v-model="event.price" type="number" min="0" step="0.01" required>
    </div>
    <button type="submit">Créer Événement</button>
  </form>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';


const runtimeConfig = useRuntimeConfig();
const url = runtimeConfig.apiUrl || runtimeConfig.public?.apiUrl;

const event = ref({
  title: '',
  description: '',
  dateTime: '',
  poster: '',
  price: ''
});

// const baseURL = 'https://localhost:8000/api/events/';

const submitEvent = async () => {
  try {
    const response = await axios.post(url + 'events' , event.value, {
      headers: {
        'Content-Type': 'application/json'
      }
    });
    alert('Événement créé avec succès !');
  } catch (error) {
    console.error('Erreur lors de la création de l\'événement:', error);
    alert('Erreur lors de la création de l\'événement');
  }
};
</script>

<style scoped lang="scss">
@import 'assets/base/colors';

form {
  max-width: 600px;
  margin: 20px auto;
  padding: 20px;
  background-color: #f5f5f5;
  border: 1px solid #ccc;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);

  div {
    margin-bottom: 10px;
    label {
      display: block;
      margin-bottom: 5px;
      color: #333;
      font-size: 14px;
    }

    input[type="text"],
    input[type="datetime-local"],
    input[type="number"],
    textarea {
      width: 100%;
      padding: 8px 10px;
      border: 1px solid #ddd;
      border-radius: 4px;
      box-sizing: border-box;

      &:focus {
        border-color: $mandarin;
        outline: none;
      }
    }

    textarea {
      height: 100px;
      resize: vertical;
    }
  }

  button {
    display: block;
    width: 100%;
    padding: 10px;
    font-size: 16px;
    color: #fff;
    background-color: $mandarin;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;

    &:hover {
      background-color: $mandarin;
    }
  }
}

</style>
