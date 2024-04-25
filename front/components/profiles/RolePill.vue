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
  
  cursor: pointer;
  transition: background-color 0.3s, border-color 0.3s;
  color: $darkgray;
  background-image: linear-gradient(to top, #d299c2 0%, #fef9d7 100%);
  border: none;
}

.role-pill.active {
  background-color: $bleupastel;
  color: $black;
  border: 1px solid $darkgray;
  
}
</style>