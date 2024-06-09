<template>
    <h1>Les abonnements</h1>
        <h2>Nous proposons 2 types d'abonnements</h2>
        <p class="h3">Choisissez celui qui vous convient le mieux</p>
        <p>Attention, un abonnement par artiste / gérant de scène. Au delà, nous vous demandons de nous contacter afin que nous vous établissions un devis.</p>
        <p>On vous a résumé le long contrat par deux cartes histoire de simplifier !</p>
        <div class="container-abonnement">
            <div class="abonnement">
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
            <div class="abonnement">
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
</template>

<style lang="scss">
@import 'assets/base/colors';
.container-abonnement{
    display: flex;
    flex-direction: column;
    .abonnement {
        border: 1px solid $darkgray;
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
    
        img {
            width: 20px;
            margin-right: 30px;
        }
    }
    }
}
@media (min-width: 830px) {

    .container-abonnement {
        display: flex;
        flex-direction: row;
        margin-right:10px;
        margin-top: 50px;
    
        
    }
}

    
</style>