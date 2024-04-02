<!-- Ceci est la page de l'abonnement  dans l'accordéon. -->
<template>
    <div>
        <h2>Abonnement</h2>
        <div v-if="!isSubscribed">
            <p>Vous n'êtes pas abonné.</p>
            <button @click="subscribe">S'abonner</button>
        </div>
        <div v-else>
            <p>Vous êtes abonné.</p>
            <button @click="unsubscribe">Se désabonner</button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            isSubscribed: false
        };
    },
    methods: {
        subscribe() {
            // Logique pour s'abonner
            this.isSubscribed = true;
        },
        unsubscribe() {
            // Logique pour se désabonner
            this.isSubscribed = false;
        }
    }
};
</script>