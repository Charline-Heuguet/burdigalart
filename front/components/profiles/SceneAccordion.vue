<template>
  <div class="scene-management">
    <p class="h3">Gérez votre scène !</p>
    <p>Créez et gérez les détails de votre scène: le nom, l'adresse, les événements, etc...</p>

    <!-- CREATION D'UNE SCENE -->
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

    <!-- OU MODIFICATION D'UNE SCENE-->
    <div v-if="scene">
      <Accordion :item="{ title: 'Détails de votre scène', content: '' }">
        <template #content>
          <div class="update-scene">
            <p>{{ scene.name }}</p>
            <button @click="selectSceneForEdit(scene)">Modifier</button>
          </div>
          <div v-if="selectedScene === scene" class="edit-form">
            <form @submit.prevent="updateScene">
              <div class="form-group">
                <label for="banner">Une photo de votre scène:</label>
                <img :src="sceneData.banner" alt="Bannière de la scène">
              </div>
              <div class="form-group">
                <label for="siret">Numéro de SIRET de votre scène:</label>
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
                <label for="capacity">Capacité de réception:</label>
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
              <ButtonSubmit>Valider les modifications</ButtonSubmit>
            </form>
          </div>
        </template>
      </Accordion>
    </div>

    <!-- Ajouter un événement -->
    <Accordion :item="{ title: 'Ajouter un événement', content: '' }">
      <template #content>
        <form @submit.prevent="createEvent">
          <div class="form-group">
            <label for="eventTitle">Titre de l'événement:</label>
            <input id="eventTitle" type="text" v-model="eventData.title" required>
          </div>
          <div class="form-group">
            <label for="eventDate">Date et Heure:</label>
            <input id="eventDate" type="datetime-local" v-model="eventData.dateTime" required>
          </div>
          <div class="form-group">
            <label for="eventDescription">Description:</label>
            <textarea id="eventDescription" v-model="eventData.description"></textarea>
          </div>
          <div class="form-group">
            <label for="eventPrice">Prix (en euros):</label>
            <input id="eventPrice" type="number" v-model="eventData.price" min="0">
          </div>
          <ButtonSubmit type="submit" class="btn btn-primary">Créer Événement</ButtonSubmit>
        </form>
      </template>
    </Accordion>

    <!-- Liste des événements -->
    <Accordion :item="{ title: 'Les événements que vous organisez', content: '' }">
      <template #content>
        <div v-if="scene && scene.events.length">
          <div v-for="event in scene.events" :key="event.id" class="event-card">
            <h3>{{ event.title }}</h3>
            <div class="desc">
              <DateIcon :dateTime="event.dateTime" />
              <div class="desc-price">
                <p>{{ event.description }}</p>
                <p>Prix: {{ event.price }} €</p>
              </div>
            </div>
          </div>
        </div>
        <div v-else>
          <p class="nothing">Aucun événement pour le moment</p>
        </div>
      </template>
    </Accordion>

    <!-- Abonnement -->
    <Accordion :item="{ title: '' }">
      <template #title>
        <span>Votre abonnement</span>
        <span v-if="!sceneData.subscription" class="alert-icon"></span>
      </template>
      <template #content>
        <div v-if="sceneData.subscription" class="subscription">
          <p>Vous êtes abonné.e</p>
          <p>Pour annuler votre abonnement à Burdigal’Art, cliquez sur ce lien...</p>
          <!-- Lien ou bouton pour se désabonner ici, non fonctionnel pour le moment -->
          <button class="danger">Se désabonner</button>
        </div>
        <div v-else class="subscription">
          <p>Vous n'êtes pas abonné.e</p>
          <p>Pour vous abonner à Burdigal’Art, cliquez sur ce lien</p>
          <NuxtLink to="profil/vous-abonner" class="success">S'abonner</NuxtLink>
          </div>
        <NuxtLink to="/abonnement">En savoir plus sur les abonnements</NuxtLink>
      </template>
    </Accordion>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import Accordion from './Accordion.vue';
import ButtonSubmit from '../ui/ButtonSubmit.vue';
import DateIcon from '../ui/DateIcon.vue';
import { useRuntimeConfig } from '#imports';
import BulleInfo from '../ui/BulleInfo.vue';

const config = useRuntimeConfig();
const apiUrl = config.public.apiUrl || config.apiUrl;

// Initialisation des données 
const scene = ref(null);
const selectedScene = ref(null);
//Structure des données pour la nouvelle scène
const sceneData = ref({
  siret: '',
  banner: 'https://fastly.picsum.photos/id/195/768/1024.jpg?hmac=rksrWrgeGQzOdzXlnzsTWy2L2zYq4gQei3TBMWCmXsI',  // Image par défaut
  name: '',
  address: '',
  zipcode: '',
  town: '',
  phoneNumber: '',
  capacity: '',
  instagram: '',
  facebook: ''
});
const showCreateForm = ref(false);// Affiche le formulaire de création
const canCreateScene = ref(true);

// Structure des données pour le nouvel événement
const eventData = ref({
  title: '',
  description: '',
  dateTime: '',
  poster: 'https://fastly.picsum.photos/id/1079/4496/3000.jpg?hmac=G-dJcpU08vEMqjUz2rb3IxjOG99rcePqW9BF1IsPLf0',
  price: 0
});

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
      sceneData.value = scene.value ? { ...scene.value } : { ...initialNewScene.value };
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

// selectSceneForEdit permet de sélectionner une scène pour la modifier
function selectSceneForEdit(scene) {
  selectedScene.value = scene;
}

// updateScene modifie les informations de la scène
async function updateScene() {
  const url = `${apiUrl}scenes/${sceneData.value.slug}`; // slug de la scène
  const payload = {
    siret: sceneData.value.siret,
    name: sceneData.value.name,
    address: sceneData.value.address,
    zipcode: String(sceneData.value.zipcode),
    town: sceneData.value.town,
    phoneNumber: sceneData.value.phoneNumber,
    capacity: sceneData.value.capacity,
    instagram: sceneData.value.instagram,
    facebook: sceneData.value.facebook
  };

  try {
    const response = await fetch(url, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${localStorage.getItem('token')}`
      },
      body: JSON.stringify(payload)
    });

    if (!response.ok) {
      throw new Error('Failed to update scene');
    }

    const responseData = await response.json();
    alert('Scène modifiée avec succès');
    console.log(responseData);
  } catch (error) {
    console.error('Error updating scene:', error);
    alert('Erreur lors de la modification de la scène');
  }
}

// createEvent crée un événement
async function createEvent() {
  try {
    console.log("Original Date:", eventData.value.dateTime);
    console.log("Converted Date:", new Date(eventData.value.dateTime).toISOString());
    eventData.value.dateTime = new Date(eventData.value.dateTime).toISOString();

    const response = await fetch(`${apiUrl}events/`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${localStorage.getItem('token')}`
      },
      body: JSON.stringify(eventData.value)
    });

    if (!response.ok) {
      const errorData = await response.json();
      throw new Error(`Failed to create event: ${errorData.message}`);
    }

    eventData.value = { title: '', dateTime: '', description: '', price: 0 }; // Réinitialiser les données du formulaire
    alert('Événement créé avec succès!');
  } catch (error) {
    console.error('Error creating event:', error);
    alert(`Erreur lors de la création de l'événement: ${error.message}`);
  }
}
onMounted(() => {
  loadScene();
});
</script>


<style scoped lang="scss">
@import 'assets/base/colors';

.h2 {
  text-align: center;
  margin-bottom: 25px;
}

.h3 {
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
  background: url('/img/icon-add.svg') no-repeat center left;
  display: inline-block;
  padding: 12px 12px 12px 40px;
  border: solid 1px $darkgray;
  border-radius: 50px;
  position: relative;
  margin-top: 12px;

  &::after {
    content: '';
    background: url('/img/icon-add.svg') no-repeat center;
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

  input,
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

  h3 {
    text-align: center;
    text-transform: uppercase;
    padding-top: 20px;
  }

  .desc {
    padding: 10px;
    display: flex;
    align-items: center;


    .desc-price {
      padding: 10px;
      margin-left: 10px;
      p{
        margin-bottom: 5px;
      }

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

  button {
    background-color: $turquoise;
    color: $black;
    font-weight: bold;
    border: none;
    padding: 10px;
    border-radius: 5px;
    cursor: pointer;
  }
}

.my-button {
  margin: 20px auto 20px;
}

.subscription {
    padding: 10px;
    border-radius: 5px;

    .success {
    max-width: fit-content;
    margin: 0 auto;
    padding: 10px;
    border-radius: 5px;
    background-color: $mandarin;
    margin-top: 12px;
}


    p:first-child {
        font-weight: bold;
        margin-bottom: 10px;
        text-align: center;
    }

    a {
        padding: 10px;
        border: none;
        border-radius: 5px;
        display: block;
        margin: 0 auto;
        font-size: 18px;

        &.danger {
            background-color: red;
            font-weight: bold;
            margin-top: 12px;
        }
    }
}

</style>