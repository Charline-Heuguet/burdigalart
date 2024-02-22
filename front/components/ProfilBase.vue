
<template>
    <div>
        <div class="avatar">
            <img src="/img/icon-avatar.svg" alt="avatar">
            <p>Modifier votre avatar</p>
        </div>
        <input type="text" name="name" id="name" placeholder="Nom">
        <input type="text" name="firstname" id="firstname" placeholder="Prénom">
        <div class="email-edit">
            <input type="text" v-model="email" name="email" id="email" placeholder="Email">
            <button @click="modifierEmail" class="edit-button">
                <img src="/img/icon-pencil.svg" alt="Modifier">
            </button>
        </div>
        <NuxtLink to="/espace-securite">
            <div class="security">
                <img src="/img/icon-padlock.svg" alt="cadenas">
                <p>Espace securité</p>
            </div>
        </NuxtLink>
        <DeconnexionButton/>
    </div>
</template>
<script setup>
import DeconnexionButton from '/components/ui/DeconnexionButton.vue';

// Variable réactive pour l'email
const email = ref('');

// Méthode pour modifier l'email
function modifierEmail() {
    // console.log(`L'email a été modifié en : ${email.value}`);
    console.log("L'email a été modifié en : ");
}
</script>
<style scoped lang="scss">
@import 'assets/base/colors';

.email-edit{
    display: flex;
    align-items: center;
    margin: 10px 0;
    input{
        width: 85%;
    }
    .edit-button{
        color: white;
        padding: 5px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 10%;
        opacity: 0.9;
        border-radius: 5px;
    }
}
.avatar{
    display: flex;
    align-items: center;
    margin: 20px 0;
    
    img{
        width: 40px;
        height: auto;
        margin-right: 10px;
        border: 1px solid black;
        border-radius: 50%;
    }
}
input{
    width: 40%;
    margin: 10px ;
    padding: 5px 5px 5px 10px;
    border: 1px solid black;
    border-radius: 10px;
    background-color: rgba(216, 215, 215, 0.458);
}
label{
    visibility: hidden;
}
#email{
    width: 85%;
}
.security{
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