<!-- Ceci est la page de l'abonnement  dans l'accordéon. -->
<template>
    <div>
        <h2>Abonnement</h2>
        <div v-if="isSubscribed === false">
            <p>Vous n'êtes pas abonné.</p>
            <p>Pour vous abonner à Burdigal’Art, cliquez sur ce lien qui vous permettra d'y souscrire en quelques étapes simples. Si vous rencontrez des difficultés, n'hésitez pas à nous contacter directement via notre support client.
            </p>
            <button @click="subscribe">S'abonner</button>
        </div>
        <div v-else>
            <p>Vous êtes abonné.</p>
            <p>Vous pouvez vous désabonner à tout moment en cliquant sur le bouton ci-dessous. Si vous rencontrez des difficultés, n'hésitez pas à nous contacter directement via notre support client.</p>
            <button @click="unsubscribe">Se désabonner</button>
        </div>
    </div>
</template>

<script>

</script>