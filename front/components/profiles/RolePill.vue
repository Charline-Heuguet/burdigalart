<template>
  <button class="role-pill" :class="{ active: isActive }" @click="$emit('selected', role)">
    {{ role }}
  </button>
</template>

<script setup>
const props = defineProps({
  role: String,
  isActive: Boolean
});
</script>

<style scoped lang="scss">
@import 'assets/base/colors';

.role-pill {
  margin: 40px 10px;
  min-width: 125px;
  padding: 5px;
  border-radius: 30px;  
  background-color: $beige;
  cursor: pointer;
  transition: background-color 0.3s, border-color 0.3s;
  background: linear-gradient(180deg, rgba(67, 132, 152, 1) 0%, rgba(67, 132, 152, 0.6558998599439776) 50%);
  color: $beige;
  text-transform: uppercase;
  letter-spacing: 0.03em;
}

.role-pill.active {
  background-color: $bleupastel;
  color: $black;
  font-weight: 600;
  border: 1px solid $darkgray;
  
}
</style>