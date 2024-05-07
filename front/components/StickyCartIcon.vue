<template>
    <div v-if="hasItems" class="sticky-cart-icon" @click="goToCart">
            <img src="/img/icon-cart.svg" alt="">
    </div>
</template>

<script setup>
import { computed } from 'vue';
import { useCartStore } from '~/stores/useCartStore';
import { useRouter } from 'vue-router';

const cartStore = useCartStore();
const router = useRouter();

const itemCount = computed(() => cartStore.items.reduce((sum, item) => sum + item.quantity, 0));
const hasItems = computed(() => itemCount.value > 0);

const goToCart = () => {
    router.push('/panier');
};
</script>

<style scoped lang="scss">
@import 'assets/base/colors';

.sticky-cart-icon {
    width: 55px;
    height: 55px;
    position: fixed;
    top: 400px; 
    right: 0px;
    background: $mandarin;
    padding: 10px;
    border-radius: 50%;
    cursor: pointer;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    z-index: 1000;

    img {
    background: transparent; 
    }
    
}

@media (min-width: 820px) {
    .sticky-cart-icon {
        width: 65px;
        height: 65px;
    }
}

</style>