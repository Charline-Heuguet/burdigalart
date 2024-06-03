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
                <PaymentComponent />
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import PaymentComponent from '~/components/PaymentComponent.vue';

const showFreemium = ref(false);
const showPremiumSection = ref(false);
const agreedToContract = ref(false);
const isPremiumSelected = ref(false);

const showFreemiumModal = () => {
    showFreemium.value = true;
};

const closeModal = () => {
    showFreemium.value = false;
};

// Mise à jour pour gérer l'affichage de la section et la mise en avant de la carte
const togglePremiumSection = () => {
    showPremiumSection.value = true;
    isPremiumSelected.value = !isPremiumSelected.value; // Bascule l'état de la sélection
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
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.4);

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
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