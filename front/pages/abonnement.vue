<template>
    <h1>Les abonnements</h1>
    <h2>Nous proposons 2 types d'abonnements</h2>
    <p class="h3">Choisissez celui qui vous convient le mieux</p>

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

    <h2>Contrat d'abonnement</h2>
    <p class="h3">Consultez le contrat d'abonnement ci-dessous pour plus d'informations</p>

    <div class="contrat">
        <h1>Contrat de service d'abonnements Burdigal'Art</h1>
        <p>Le présent contrat de service d'abonnements (le « Contrat ») est conclu entre Burdigal'Art (« Burdigal'Art »
            ou « nous ») et l'utilisateur (« le Client ») qui souscrit à un abonnement payant sur le
            site web Burdigal'Art (le « Site »).</p>

        <h2>1. Objet du Contrat</h2>
        <p>Le présent Contrat a pour objet de définir les modalités selon lesquelles le Client accède et utilise les
            services proposés par Burdigal'Art dans le cadre de son abonnement.</p>

        <h2>2. Services fournis</h2>
        <p>Burdigal'art s’engage à fournir les services suivants au Client:</p>
        <ul>
            <li>- Une mise en avant sur la page à la une et sur tous les espaces du site prévue à cet effet. </li>
        </ul>

        <h2>3. Durée de l'abonnement</h2>
        <p>La durée de l’abonnement est de minimum 12 (douze) mois à compter de la date de signature du contrat. Ce
            contrat est automatiquement reconduit pour l'année suivante, sauf si le client envoie un mail exprimant sa
            décision de ne pas renouveler l'abonnement 2 (deux) mois avant la fin du contrat actuel. En absence de
            réponse, le contrat est considéré par défaut comme non-renouvelé.</p>
        <p>En cas de non-renouvellement du contrat, le Client perdra la mise en avant de son profil sur le site à la
            date anniversaire du contrat.</p>

        <h2>4. Prix et modalités de paiement</h2>
        <p>Le Client s’engage à payer les frais d’abonnement en une seule fois. Le paiement peut être effectué par
            virement bancaire, via PayPal, ou directement en ligne sur le site. Les modalités de paiement sont les
            suivantes :</p>
        <ul>
            <li>- Pour les artistes et les scènes, la mise en avant de leurs profils est proposée pour la somme de
                60(soixante) euros
                pour une année soit pour une durée d'engagement de 12 (douze) mois. </li>
            <li>- Pour les scènes, la création d’un compte qu’il soit gratuit ou premium entraîne l'acceptation du
                barème en pourcentage ci-dessous, calculé en fonction du nombre de billets vendus lors de l'évènement.
            </li>
        </ul>
        <p>Sur les ventes de billets, les jauges des Scènes s’appliquent en pourcentage.</p>
        <p class="important">Pourcentages sur les prix du billet : </p>
        <ul>
            <li>- Moins de 200 spectateurs: 5%</li>
            <li>- Plus de 500 spectateurs: 10 %</li>
            <li>- Plus de 1 000 spectateurs: 15% sur le prix du billet</li>
        </ul>

        <h2>5. Résiliation</h2>
        <p>Chaque partie peut résilier le contrat moyennant un préavis écrit de 2 (deux) mois après la fin de la
            première année. Ce mail devra être envoyé à l'adresse mail suivante : "contact@burdigalart.com" avec comme
            objet: "Résiliation".</p>

        <h2>6. Confidentialité</h2>
        <p>Les informations échangées entre les parties dans le cadre de ce contrat sont confidentielles et ne peuvent
            être divulguées à des tiers sans consentement mutuel écrit.</p>

        <h2>7. Responsabilité</h2>
        <p>Burdigal'Art s’engage à fournir les services de manière professionnelle et à résoudre tout problème dans les
            plus brefs délais. Le Client s’engage à respecter les conditions d’utilisation et à fournir toute
            information nécessaire à
            Burdigal'Art.</p>

        <h2>8. Loi applicable</h2>
        <p>Le présent Contrat est régi par le droit français. Tout litige relatif à son interprétation ou à son
            exécution sera de la compétence exclusive des tribunaux français.</p>

        <h2>9. Signature du Contrat</h2>
        <p>En acceptant ce contrat, les parties reconnaissent avoir lu et accepté l’ensemble des termes et conditions.
        </p>
        <p>Le présent contrat est signé électroniquement par le Client lors de la souscription à l’abonnement.</p>

        <h2>10. Téléchargement du Contrat</h2>
        <p>Le Client est libre de télécharger le présent contrat sous format .pdf en cliquant sur: <a
                href="/medias/contrat-abonnement.pdf" download="contrat_abonnement.pdf">Télécharger le contrat</a>
        </p>
        <p class="important">Date de dernière mise à jour : Avril 2024 </p>
    </div>
</template>

<style scoped lang="scss">
@import 'assets/base/colors';

a {
    color: $darkgray;
    text-decoration: underline;

}

h2 {
    font-size: 1.5em;
    font-weight: bold;
    margin: 30px 0;
}

.h3 {
    font-size: 1.2em;
    margin: 20px 0;

}

.container-abonnement {
    display: flex;
    justify-content: space-around;
    margin-top: 50px;

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
        }

        img {
            width: 20px;
            margin-right: 30px;
        }
    }
}


.contrat {
    margin: 30px auto 0;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
    background-color: rgba(247, 241, 235, 0.7);
    border-radius: 8px;

    h1 {
        margin-top: 10px;
    }

    h2 {
        margin-top: 30px;
        margin-bottom: 10px;
    }

    p,
    li {
        margin-bottom: 10px;
        line-height: 1.8em;
    }

    .important {
        margin-top: 20px;
        text-decoration: underline;
        font-weight: bold;
    }
}
</style>