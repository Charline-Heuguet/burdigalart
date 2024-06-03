<template>
  <div v-if="sceneData">
    <p class="h2">Rideau, en haut !</p>
        <p class="h3">Gérez la fiche de votre établissement: nom, bannière, adresse, les évènements que vous organisez...</p>
    <!-- La fiche-->
    <Accordion :item="{ title: 'La fiche de votre scène', content: '' }">
      <template #content>
        <form @submit.prevent="updateSceneDetails">
          <div class="form-group">
            <label for="banner">Une photo de votre scène:</label>
            <img :src="sceneData.banner" alt="Bannière de la scène">
            <input type="file" id="banner" @change="handleBannerChange">
          </div>
          <div class="form-group">
            <label for="siret">Numéro de SIRET de votre scène:
              <BulleInfo>Attention, ce numéro est vérifié</BulleInfo>
            </label>
            <input type="text" id="siret" v-model="sceneData.siret" placeholder="Numéro à 14 chiffres" >
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
          <OrangeButton>Valider</OrangeButton> 
        </form>
      </template>
    </Accordion>

    <!-- Les événements à venir -->
    <Accordion :item="{ title: 'Les événements que vous organisez', content: '' }">
      <template #content>
        <!-- ajouter un évènement -->
        <div v-for="event in upcomingEvents" :key="event.title" class="event-card">
          <img :src="event.poster" alt="">
          <h3>{{ event.title }}</h3>
          <div class="event-details">
            <div>
              <DateIcon :dateTime="event.dateTime" />
            </div>
            <div class="desc">
              <p>{{ event.description }}</p>
              <p>Prix : {{ event.price }} euros</p>
            </div>
          </div>
          <div v-if="upcomingEvents.length > 1" class="separator"></div>
        </div>
        <div class="text-center">
          <NuxtLink to="/scenes/ajouter-un-evenement" class="add">
            <p>Ajouter un évènement</p>
          </NuxtLink>
        </div>
        <p class="nothing" v-if="upcomingEvents.length === 0">Aucun événement à venir.</p>
      </template>
    </Accordion>

    <!-- Les évènements passés -->
    <Accordion :item="{ title: 'Les événements passés', content: '' }">
      <template #content>
        <div v-for="event in pastEvents" :key="event.title" class="event-card">
          <img :src="event.poster" alt="">
          <h3>{{ event.title }}</h3>
          <div class="event-details">
            <div>
              <DateIcon :dateTime="event.dateTime" />
            </div>
            <div class="desc">
              <p>{{ event.description }}</p>
              <p>Prix : {{ event.price }} euros</p>
            </div>
          </div>
          <div class="separator"></div>
        </div>
        <p class="nothing" v-if="pastEvents.length === 0">Aucun événement passé.</p>
      </template>
    </Accordion>

    <!-- Section abonnement -->
    <Accordion :item="{ title: '' }">
            <template #title>
                <span>Votre abonnement</span>
                <span v-if="!sceneData.subscription" class="alert-icon"></span>
            </template>
      <template #content>
        <div v-if="sceneData.subscription === true" class="subscription">
          <p>Vous êtes abonné.e !</p>
          <p>Pour annuler votre abonnement à Burdigal’Art, cliquez sur ce lien qui vous permettra d'annuler votre abonnement en quelques étapes simples.</p> <p>Si vous rencontrez des difficultés, n'hésitez pas à nous contacter
            directement via notre support client.</p>
          <button @click="unsubscribe" class="danger">Se désabonner</button>
        </div>
        <div v-else>
          <p>Vous n'êtes pas abonné.e !</p>
          <p>Pour vous abonner à Burdigal’Art, cliquez sur ce lien qui vous permettra d'y souscrire en quelques étapes simples.</p>
          <p>Si vous rencontrez des difficultés, n'hésitez pas à nous contacter directement via notre support client.
          </p>
          <button @click="subscribe" class="success">S'abonner</button>
        </div>
      </template>
    </Accordion>

  </div>
</template>

<script setup>
import { ref } from 'vue';
import Accordion from './Accordion.vue';
import DateIcon from '../ui/DateIcon.vue';
import { useAsyncData } from 'nuxt/app';
import OrangeButton from '../ui/OrangeButton.vue';
import BulleInfo from '../ui/BulleInfo.vue';

// En dur pour les tests: A CHANGER
const baseUrl = 'https://localhost:8000/api';
const sceneSlug = 'le-petit-grain';

const { data: sceneData, error, pending, refresh } = useAsyncData(`scene-${sceneSlug}`, () => {
  return $fetch(`${baseUrl}/scenes/${sceneSlug}`);
});

// Pour les évènements à venir:
const upcomingEvents = computed(() => {
  return sceneData.value ? sceneData.value.events.filter(event => new Date(event.dateTime) > new Date()) : [];
});
console.log(upcomingEvents);

// Pour les évènements passés:
const pastEvents = computed(() => {
  return sceneData.value ? sceneData.value.events.filter(event => new Date(event.dateTime) <= new Date()) : [];
});
console.log(pastEvents);


const handleBannerChange = (event) => {
  console.log("Banner file selected:", event.target.files[0]);
};

// Méthode pour mettre à jour les détails de la scène
const updateSceneDetails = () => {
  console.log("Updating scene details:", sceneData);
};
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
  margin-bottom: 12px;
  
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
</style>