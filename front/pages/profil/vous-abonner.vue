<template>
    <div>
        <h1>Les abonnements</h1>
        <h2>Nous proposons 2 types d'abonnements</h2>
        <p class="h3">Choisissez celui qui vous convient le mieux</p>
        <p>Attention, un abonnement par artiste / gérant de scène. Au delà, nous vous demandons de nous contacter afin
            que nous vous établissions un devis.</p>

        <div class="container-abonnement">
            <!-- CARD FREEMIUM -->
            <div class="abonnement" @click="showFreemiumModal" :class="{ 'grayed-out': isPremiumSelected }">
                <h2>Abonnement Freemium</h2>
                <p class="h2">Gratuit</p>
                <div class="avantages">
                    <img src="/img/icon-croix.svg" alt="une croix rouge">
                    <p>Pas de mise en avant</p>
                </div>
                <div class="avantages">
                    <img src="/img/icon-croix.svg" alt="une croix rouge">
                    <p>Vous n'apparaissez pas sur la page d'accueil.</p>
                </div>
            </div>
            <!-- CARD PREMIUM -->
            <div class="abonnement" @click="togglePremiumSection" :class="{ 'highlight': isPremiumSelected }">
                <h2>Abonnement Premium</h2>
                <p class="h2">60 euros par an</p>
                <div class="avantages">
                    <img src="/img/icon-check.svg" alt="un signe qui represente un V">
                    <p>Mise en avant sur toutes les pages qui listent les scènes / les artistes</p>
                </div>
                <div class="avantages">
                    <img src="/img/icon-check.svg" alt="un signe qui represente un V">
                    <p>Vous apparaissez sur la page d'accueil</p>
                </div>
            </div>
        </div>

        <!-- Modal Freemium -->
        <div class="modal" v-show="showFreemium" @click="closeModal">
            <div class="modal-content" @click.stop>
                <span class="close" @click="closeModal">&times;</span>
                <p>Vous n'avez rien à faire de plus pour le moment, vous pouvez vous promener sur le site, découvrir des
                    artistes, des événements ou mettre à jour votre fiche</p>
            </div>
        </div>

        <!-- Premium Section -->
        <div v-show="showPremiumSection" class="premium-section">
            <h2>Contrat d'abonnement</h2>
            <p>Vous pouvez consulter le contrat en vous rendant à cette page:
                <NuxtLink to="/abonnement">Voir le contrat d'abonnement</NuxtLink>
            </p>

            <div class="dl">
                <p>Vous pouvez également le télécharger ci-après:</p>
                <a href="/medias/contrat-abonnement.pdf" download="contrat_abonnement.pdf">
                    <img src="/img/icon-dl.svg" alt="une fleche pointant vers le bas entourée d'un nuage">
                </a>
            </div>
            <label for="agreeCheckbox" class="checkbox">Je suis d'accord avec le contrat et cet accord vaut pour
                signature</label>
            <input type="checkbox" id="agreeCheckbox" v-model="agreedToContract">
            <!-- Affiche le composant de paiement uniquement si la checkbox est cochée -->
            <div v-if="agreedToContract" class="payment-section">
                <PaymentComponent @payment-successful="handlePaymentSuccess" />
            </div>
        </div>

        <div class="modal" v-if="subscriptionMessage" @click="closeSubscriptionModal">
            <div class="modal-content">
                <span class="close" @click="closeSubscriptionModal">&times;</span>
                <p>{{ subscriptionMessage }}</p>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import PaymentComponent from '~/components/PaymentComponent.vue';
import {jwtDecode} from 'jwt-decode';
import { useRouter } from 'vue-router';

const runtimeConfig = useRuntimeConfig();
const url = runtimeConfig.apiUrl || runtimeConfig.public?.apiUrl;

const showFreemium = ref(false);
const showPremiumSection = ref(false);
const agreedToContract = ref(false);
const isPremiumSelected = ref(false);
const subscriptionMessage = ref('');
const router = useRouter();


// Fonction pour afficher la modale Freemium
const showFreemiumModal = () => {
    showFreemium.value = true;
};
// Fonction pour fermer la modale
const closeModal = () => {
    showFreemium.value = false;
};

// Mise à jour pour gérer l'affichage de la section et la mise en avant de la carte
const togglePremiumSection = () => {
    showPremiumSection.value = true;
    isPremiumSelected.value = !isPremiumSelected.value; // Bascule l'état de la sélection
};

// Fonction pour récupérer le token de l'utilisateur
const getToken = () => {
  return localStorage.getItem('token');
};

const handlePaymentSuccess = (paymentSuccess) => {
    console.log("Payment successful, subscribing now...");
    subscribe();
};

const subscribe = () => {
  console.log("Fetching token from storage...");
  const token = getToken();  // S'assurer que le token est récupéré ici
  if (!token) {
    console.error("No token found, user might not be logged in.");
    return;  // Sortir de la fonction si aucun token n'est trouvé
  }
  const decoded = jwtDecode(token);
  console.log("Token decoded, roles:", decoded.roles);
  const roles = decoded.roles;

  if (roles.includes('ROLE_SCENE')) {
    console.log("Calling subscribe API for SCENE...");
    callSubscribeApi(url + 'scenes/user/subscribe', token);  // Passer le token comme argument
  } else if (roles.includes('ROLE_ARTISTE')) {
    console.log("Calling subscribe API for ARTISTE...");
    callSubscribeApi(url + 'artists/user/subscribe', token);  // Passer le token comme argument
  }
};


const callSubscribeApi = async (apiUrl, token) => {  // Ajouter token comme paramètre
  console.log("API call to:", apiUrl);
  try {
    const response = await fetch(apiUrl, {
      method: 'PATCH',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${token}`  // Utiliser le token dans le header Authorization
      },
      body: JSON.stringify({ subscription: true })
    });

    if (response.ok) {
      const data = await response.json();
      console.log('Subscription successful:', data.message);
      subscriptionMessage.value = "Félicitations, vous êtes abonné.e à Burdigarl'Art ! Quand vous fermerez cette fenêtre, vous serez redirigé vers votre profil";
    } else {
      throw new Error('Failed to subscribe with status: ' + response.status);
    }
  } catch (error) {
    console.error('Error subscribing:', error.message);
  }
};

const closeSubscriptionModal = () => {
    subscriptionMessage.value = ''; 
    router.push('/profil'); 
};


</script>

<style scoped lang="scss">
@import 'assets/base/colors';
.container-abonnement {
    display: flex;
    justify-content: space-around;
    margin-top: 50px;

    .highlight {
        border: 2px solid $pink;
        /* Bordure rouge pour la carte sélectionnée */
    }

    .grayed-out {
        opacity: 0.5;
        pointer-events: none;
    }

    .abonnement {
        max-width: 400px;
        margin: 20px auto;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        background-color: rgba(247, 241, 235, 0.7);
        border-radius: 8px;




        h2 {
            text-align: center;
            text-transform: uppercase;
            font-weight: bold;
            margin-top: 0px;
        }

        .h2 {
            font-weight: bold;
            text-align: center;
            margin: 15px 0;
        }

        .avantages {
            display: flex;
            align-items: center;
            margin-top: 30px;
        }

        img {
            width: 20px;
            margin-right: 30px;
        }
    }
}

// Modale pour la carte Freemium
.modal {
    display: block;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    bottom: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.4);

    .modal-content {
        background-color: #fefefe;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #888;
        max-width: 600px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
    }
}

// Section qui s'affiche après la sélection de l'abonnement Premium
.premium-section {
    max-width: 600px;
    margin: 30px auto 0;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
    background-color: rgba(247, 241, 235, 0.7);
    border-radius: 8px;

    .payment-section {
        margin-top: 30px;
    }

    .checkbox {
        margin-right: 20px;
    }
    .dl{
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        margin-top: 10px;
        img {
            width: 20px;
            margin-right: 10px;
        }
    }

}
</style>