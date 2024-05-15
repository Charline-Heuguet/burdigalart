<template>
    <div v-if="user">
        <div class="avatar">
            <p class="h2" v-if="isLogged">Bonjour {{ user.firstName }} !</p>
            <p class="h3">Ici, retrouves tous tes évènements!</p>
        </div>
    </div>
    <div v-else>
        <p>Chargement...</p>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { jwtDecode } from "jwt-decode";

const baseURL = 'https://localhost:8000/api/';
const token = ref(localStorage.getItem('token')); // Stocke le token depuis localStorage

const user = ref(null);
const error = ref(null);
const isLogged = ref(false);

// si le JWT est valide et met à jour isLogged
function checkJwtValidity() {
  if (!token.value) {
    console.error('No token available.');
    isLogged.value = false;
    return;
  }
  try {
    const decodedToken = jwtDecode(token.value);
    const currentTime = Date.now() / 1000;
    isLogged.value = decodedToken.exp > currentTime;
  } catch (err) {
    console.error('Error decoding JWT:', err);
    isLogged.value = false;
  }
}

// Charger les données de l'utilisateur à partir de l'API
async function loadUserData() {
  checkJwtValidity(); // Vérifier d'abord la validité du JWT
  if (!isLogged.value) {
    console.error('JWT is not valid or expired');
    return;
  }

  const decoded = jwtDecode(token.value);
  const userId = decoded.user_id;

  try {
    const response = await fetch(`${baseURL}users/${userId}`, {
      headers: { 'Authorization': `Bearer ${token.value}` }
    });
    if (!response.ok) throw new Error(`Failed to fetch user data: Status ${response.status}`);
    user.value = await response.json();
  } catch (err) {
    error.value = err.message;
    console.error('Error fetching user data:', err.message);
  }
}

onMounted(loadUserData);
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