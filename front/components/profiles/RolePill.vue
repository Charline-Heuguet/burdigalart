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
  min-width: 106px;
  padding: 5px;
  border-radius: 30px;
  border: 1px solid $darkgray;
  background-color: #f0f0f0;
  cursor: pointer;
  transition: background-color 0.3s, border-color 0.3s;
  color: $darkgray;
  background-color: $beigeclair;
}

.role-pill.active {
  background-color: $bleupastel;
  color: $black;
  border: none;
}
</style>