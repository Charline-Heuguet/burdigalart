<template>
    <div v-if="user">
        <div class="avatar">
            <p class="h2" v-if="user.firstName">Bonjour {{ user.firstName }} !</p>
            <p class="h3">Ici, retrouves tous tes évènements!</p>
        </div>
        <p>{{console.log("toto")}}</p>
    </div>
    <div v-else>
        <p>Chargement...</p>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { jwtDecode } from "jwt-decode";

const runtimeConfig = useRuntimeConfig();
const url = runtimeConfig.apiUrl || runtimeConfig.public?.apiUrl;
const user = ref(null);
const error = ref(null);
let token;

// Charge les données de l'utilisateur à partir de l'API
async function loadUserData() {
  try {
    const decoded = jwtDecode(token);
    const userId = decoded.user_id;

    const response = await fetch(`${url}users/${userId}`, {
      headers: { 'Authorization': `Bearer ${token}` }
    });
    if (!response.ok) throw new Error('Failed to fetch user data');
    user.value = await response.json();
  } catch (err) {
    error.value = err.message;
    console.error('Error fetching user data:', err.message);
  }
}

onMounted(() => {
  token = localStorage.getItem('token');
  loadUserData();
});
</script>

<style scoped lang="scss">
@import 'assets/base/colors';

.avatar{
    margin: 20px auto 40px;
    text-align: center;
    
    img{
        width: 150px;
        height: auto;
        margin-right: 10px;
        border-radius: 20px;
        margin-right: 30px;
    }
}
input{
    width: 40%;
    margin: 10px ;
    padding: 5px 5px 5px 10px;
    border: 1px solid $darkgray;
    border-radius: 10px;
    background-color: rgba(216, 215, 215, 0.458);
}
label{
    visibility: hidden;
}
#email{
    width: 85%;
}
.setting{
    display: flex;
    align-items: center;
    margin: 40px 0;
    img{
        width: 20px;
        height: auto;
        margin-right: 15px;
    }
}

</style>