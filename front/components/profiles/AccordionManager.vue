<template>
    <div>
        <Accordion :item="item">
      <template #title>
        <p>{{ item.title }}</p>
      </template>
      <template #content>
        <p>{{ item.content }}</p>
      </template>
    </Accordion>
    </div>
</template>

<script>

const itemsManager = [
  { title: 'La fiche de votre scene', content: 'Contenu 1' },
  { title: 'Les évènements à venir', content: 'Contenu 2' },
  { title: 'Votre historique', content: 'Contenu 3' },
  { title: 'Votre abonnement', content: 'Contenu 3' }
];
</script>