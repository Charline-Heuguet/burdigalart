<template>
    <div class="reservation-container">
        <h1>Votre panier</h1>
        <div class="items">
            <div v-for="item in items" :key="item.id" class="item">
                <div class="item-info">
                    <span class="item-show">{{ item.show }}</span>
                    <span class="item-price">{{ item.price.toFixed(2) }} € la place</span>
                </div>
                <div class="item-quantity">
                    <button @click="decrement(item.id)">-</button> 
                    <span>{{ item.quantity }}</span>
                    <button @click="increment(item.id)">+</button> 
                </div>
                <span class="item-total">{{ calculateItemTotal(item).toFixed(2) }} €</span>
                <img src="/img/icon-trash2.svg" alt="Supprimer" @click="removeItem(item.id)"> 
            </div>
        </div>
        <div class="total">
            Total:<span>{{ calculateTotal.toFixed(2) }} €</span>
        </div>
        <NuxtLink to="/paiement">
            <OrangeButton @click="validateOrder">Valider ma commande</OrangeButton>
        </NuxtLink>
        <p class="info-redirection">Redirection vers la page de paiement</p>
    </div>
</template>

  
<script setup lang="ts">
import { computed } from 'vue';
import OrangeButton from '~/components/ui/OrangeButton.vue';
import { useCartStore } from '~/stores/useCartStore';
import type { Item } from '~/types/interfaces/item';

const cartStore = useCartStore();

const items = computed<Item[]>(() => cartStore.items);
const calculateTotal = computed(() => cartStore.calculateTotal); // Retirer les parenthèses

const calculateItemTotal = (item) => {
  return item.quantity * item.price;
};

const increment = (id) => {
  cartStore.increment(id);
};

const decrement = (id) => {
  cartStore.decrement(id);
};

const removeItem = (id) => {
  cartStore.removeItem(id);
};

const validateOrder = () => {
  cartStore.validateOrder();
};
</script>

  
  
<style lang="scss" scoped>
@import 'assets/base/colors';

.reservation-container {
    margin: 2rem auto;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    background-color: white;

    img{
        width: 20px;
        height: auto;
        cursor: pointer;
    }

    h1 {
        text-align: center;
    }

    .items {
        margin-bottom: 2rem;

        .item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #40403F;

            &-info {
                min-width: 130px;

                .item-title,.item-show {
                    display: block;
                    margin: 5px 0;
                }

                .item-show {
                    font-style: italic;
                }

                .item-price {
                    font-size: 0.875rem;
                }                
            }

            .item-quantity {
                display: flex;
                align-items: center;

                button {
                    min-width: 20px;
                    border: none;
                    background-color: #f2f2f2;
                    cursor: pointer;
                    margin: 10px;
                    border-radius: 4px;

                    &:hover {
                        background-color: #e2e2e2;
                    }
                }
            }

            .item-total {
                font-weight: bold;
            }
        }
    }

    .info-redirection{
            margin-top: 10px;
            font-style: italic;
        }

    .total {
        display: flex;
        justify-content: flex-end;
        font-size: 1.25rem;
        font-weight: bold;
        margin-bottom: 2rem;

        span{
            padding-left: 15px;
        }
    }

    .validate-button {
        width: 100%;
        padding: 1rem;
        background-color: #ff9000;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        color: white;
        font-size: 1rem;
        text-transform: uppercase;
        transition: background-color 0.3s ease;

        &:hover {
            background-color: #e68900;
        }
    }

    p {
        text-align: center;
        color: #777;
        font-size: 0.875rem;
    }
}
</style>
  