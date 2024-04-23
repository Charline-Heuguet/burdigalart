<!-- DateIcon.vue -->
<template>
  <div class="date-icon">
    <div class="date-number">{{ day }}</div>
    <div class="date-month">{{ month.toUpperCase() }}</div>
  </div>
</template>

<script setup>
const props = defineProps({
  dateTime: String
});

const date = new Date(props.dateTime);
const day = date.getDate();
const month = date.toLocaleDateString('fr-FR', { month: 'short' });
</script>

<style scoped>
.date-icon {
  min-width: 68px;
  display: inline-block;
  text-align: center;
  border: 1px solid black;
  background-color: black;
  border-radius: 10px;
  overflow: hidden;
  user-select: none;
}

.date-number {
  background-color: #fff;
  border-radius: 8px;
  color: #000;
  padding: 6px;
  font-size: 24px;
  font-weight: bold;
  border-bottom: 1px solid #000;
}

.date-month {
  background-color: #000;
  color: #fff;
  padding: 8px ;
  font-size: 18px;
}
</style>
