<template>
  <div>
    <PaymentComponent @payment-successful="handlePaymentSuccess" />
  </div>
</template>

<script setup>
import PaymentComponent from '~/components/PaymentComponent.vue';
import { useRoute, useRuntimeConfig } from '#imports';

const runtimeConfig = useRuntimeConfig();
const url = runtimeConfig.apiUrl || runtimeConfig.public?.apiUrl;  // Utilisation conforme à ta demande

const route = useRoute();
const slug = route.params.slug; // Utiliser directement le slug récupéré de l'URL

async function handlePaymentSuccess() {
  try {
    const response = await $fetch(`${url}events/${slug}/buy`, {
      method: 'POST'
    });
    console.log('Achat réussi', response);
    // Ajouter ici la logique de post-traitement comme la redirection ou la notification
  } catch (error) {
    console.error('Erreur d\'achat', error);
    // Afficher une notification ou gérer l'erreur de manière appropriée
  }
}
</script>
