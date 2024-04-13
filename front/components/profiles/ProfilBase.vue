
<template>
    <div>
        <div class="avatar">
            <img src="/img/icon-avatar.svg" alt="avatar">
            <p> Bonjour {{Prénom}}</p>
        </div>
        <input type="text" name="name" id="name" placeholder="Nom">
        <input type="text" name="firstname" id="firstname" placeholder="Prénom">
        <input type="text" v-model="email" name="email" id="email" placeholder="Email">
        
        <NuxtLink to="/profil/parametres">
            <div class="setting">
                <img src="/img/icon-settings.svg" alt="">
                <p> Paramètres de votre compte.</p>
            </div>
        </NuxtLink>
    </div>
</template>
<script setup>

</script>
<style scoped lang="scss">
@import 'assets/base/colors';

.avatar{
    display: flex;
    align-items: center;
    margin: 20px 0;
    
    img{
        width: 80px;
        height: auto;
        margin-right: 10px;
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