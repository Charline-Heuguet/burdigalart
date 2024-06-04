<template>
    <div class="scene-management">
        <p class="h3">Gérez votre scène !</p>
        <p>Créez et gérez les détails de votre scène: le nom, l'adresse, les événements, etc...</p>

        <div v-if="canCreateScene">
            <ButtonSubmit class="my-button" @click="showCreateForm = true">Créer votre scène</ButtonSubmit>
            <Accordion v-if="showCreateForm" :item="{ title: 'Créer une scène', content: '' }">
                <template #content>
                    <form @submit.prevent="createScene">
                        <div class="form-group">
                            <label for="banner">Une photo de votre scène:</label>
                            <img :src="sceneData.banner" alt="Bannière de la scène">
                            <input type="file" id="banner" @change="handleBannerChange">
                        </div>
                        <div class="form-group">
                            <label for="siret">Numéro de SIRET de votre scène:
                                <BulleInfo>Attention, ce numéro est vérifié</BulleInfo>
                            </label>
                            <input type="text" id="siret" v-model="sceneData.siret" placeholder="Numéro à 14 chiffres">
                        </div>
                        <div class="form-group">
                            <label for="name">Nom de la scène:</label>
                            <input type="text" id="name" v-model="sceneData.name">
                        </div>
                        <div class="form-group">
                            <label for="address">Adresse de la scène:</label>
                            <input type="text" id="address" v-model="sceneData.address">
                        </div>
                        <div class="form-group">
                            <label for="zipcode">Code postal:</label>
                            <input type="text" id="zipcode" v-model="sceneData.zipcode">
                        </div>
                        <div class="form-group">
                            <label for="town">Ville:</label>
                            <input type="text" id="town" v-model="sceneData.town">
                        </div>
                        <div class="form-group">
                            <label for="capacity">Capacité de réception:
                                <BulleInfo>Nombre de personnes maximum</BulleInfo>
                            </label>
                            <input type="text" id="capacity" v-model="sceneData.capacity">
                        </div>
                        <div class="form-group">
                            <label for="phoneNumber">Numero de telephone:</label>
                            <input type="text" id="phoneNumber" v-model="sceneData.phoneNumber">
                        </div>
                        <div class="form-group">
                            <label for="instagram">Instagram:</label>
                            <input type="text" id="instagram" v-model="sceneData.instagram">
                        </div>
                        <div class="form-group">
                            <label for="facebook">Facebook:</label>
                            <input type="text" id="facebook" v-model="sceneData.facebook">
                        </div>
                        <ButtonSubmit>Valider</ButtonSubmit>
                    </form>
                </template>
            </Accordion>
        </div>

        <!-- Si l'utilisateur a une scene relié à son compte : détails + possibilité de modif -->
        <div v-if="scene">
            <Accordion :item="{ title: 'Détails de ' + sceneData.name, content: '' }">
                <template #content>
                    <div class="update-scene">
                        <p>{{ scene.name }}</p>
                        <ButtonSubmit @click="editScene">Modifier</ButtonSubmit>
                    </div>
                </template>
            </Accordion>
        </div>

        <!-- Ajouter un événement -->
    <!-- <Accordion :title="'Ajouter un événement'">
      <template #content>
        <form @submit.prevent="createEvent">
          <div class="form-group">
            <label for="eventTitle">Titre de l'événement:</label>
            <input id="eventTitle" v-model="eventData.title" type="text" required>
          </div>
          <div class="form-group">
            <label for="eventDate">Date et Heure:</label>
            <input id="eventDate" v-model="eventData.dateTime" type="datetime-local" required>
          </div>
          <div class="form-group">
            <label for="eventDescription">Description:</label>
            <textarea id="eventDescription" v-model="eventData.description"></textarea>
          </div>
          <div class="form-group">
            <label for="eventPrice">Prix:</label>
            <input id="eventPrice" v-model="eventData.price" type="number" min="0">
          </div>
          <button type="submit" class="btn btn-primary">Créer Événement</button>
        </form>
      </template>
    </Accordion> -->
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import Accordion from './Accordion.vue';
import ButtonSubmit from '../ui/ButtonSubmit.vue';
import { useRuntimeConfig } from '#imports';
import BulleInfo from '../ui/BulleInfo.vue';

const config = useRuntimeConfig();
const apiUrl = config.public.apiUrl || config.apiUrl;

const scene = ref(null);
const sceneData = ref({
    banner: 'https://fastly.picsum.photos/id/195/768/1024.jpg?hmac=rksrWrgeGQzOdzXlnzsTWy2L2zYq4gQei3TBMWCmXsI',  // Image par défaut
    siret: '',
    name: '',
    address: '',
    zipcode: '',
    town: '',
    capacity: '',
    phoneNumber: '',
    instagram: '',
    facebook: ''
});
const showCreateForm = ref(false);
const canCreateScene = ref(true);

// loadScene récupère la scène de l'utilisateur connecté
const loadScene = async () => {
    try {
        const token = localStorage.getItem('token');
        const response = await fetch(`${apiUrl}scenes/user/byuser`, {
            headers: { 'Authorization': `Bearer ${token}` }
        });
        if (response.ok) {
            const data = await response.json();
            scene.value = data.length ? data[0] : null;
            canCreateScene.value = !scene.value;
            sceneData.value = scene.value ? scene.value : { ...initialNewScene.value };
        }
    } catch (error) {
        console.error('Failed to load scene:', error);
    }
};

// createScene crée une nouvelle scène
const createScene = async () => {
    try {
        const token = localStorage.getItem('token');
        const response = await fetch(`${apiUrl}scenes/`, {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(sceneData.value)
        });
        if (response.ok) {
            await loadScene();
            showCreateForm.value = false;
            alert('Scène créée avec succès!');
        } else {
            alert('Erreur lors de la création de la scène');
        }
    } catch (error) {
        console.error('Error creating scene:', error);
        alert('Erreur lors de la création de la scène');
    }
};

onMounted(() => {
    loadScene();
});
</script>


<style scoped lang="scss">
@import 'assets/base/colors';
.h2{
    text-align: center;
    margin-bottom: 25px;
}
.h3{
    margin: 0 0 30px;
}
.alert-icon {
    width: 10px;
    height: 10px;
    background-color: #9e0101;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    font-size: 24px;
    margin-left: 10px;
}

.add {
  background:url('/img/icon-add.svg') no-repeat center left;
  display: inline-block;
  padding: 12px 12px 12px 40px;
  border: solid 1px $darkgray;
  border-radius: 50px;
  position: relative;
  margin-top: 12px;
  
  &::after{
    content: '';
    background:url('/img/icon-add.svg') no-repeat center;
    background-size: contain;
    width: 20px;
    height: 20px;
    display: block;
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    border: 1px solid $darkgray;
    border-radius: 20px;
  }
}

.form-group {
  margin-bottom: 5px;
  padding: 12px;

  label {
    display: block;
    margin-bottom: .5rem;
  }

  input[type="text"],
  textarea {
    width: 100%;
    padding: .5rem;
    line-height: 1.5;
    border: 1px solid #ccc;
    border-radius: .25rem;
  }

  #banner {
    margin-top: 12px;
  }

}

.event-card {
  padding: 15px;

  .separator {
    width: 50%;
    border-bottom: 1px solid black;
    margin: 20px auto;
  }

  h3 {
    text-align: center;
    padding-top: 20px;
  }

  img {
    display: none;
  }

  .event-details {
    display: flex;
    padding: 15px;

    .desc {
      display: flex;
      flex-direction: column;
      justify-content: space-around;
      margin-left: 25px;
    }
  }
}

.nothing {
  padding: 12px;
}

.subscription {
  padding: 10px;
  border-radius: 5px;

  p:first-child {
    font-weight: bold;
    margin-bottom: 10px;
    text-align: center;
  }

  button {
    padding: 10px;
    border: none;
    border-radius: 5px;
    display: block;
    margin: 0 auto;
    font-size: 18px;

    &.danger {
      background-color: rgb(245, 59, 59);
      margin-top: 12px;
    }

    &.success {
      background-color: $mandarin;
      margin-top: 12px;
    }
  }
}

.update-scene {
    display: flex;
    justify-content: space-around;
    align-items: center;
    padding: 20px;
    border-bottom: 1px solid #ccc;

    button{
        background-color: $turquoise;
        color: $black;
        border: none;
        text-shadow: none;
    }
}
</style>