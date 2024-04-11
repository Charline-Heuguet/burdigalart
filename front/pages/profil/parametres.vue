<template>
    <div>
        <h2> Paramètres de votre compte</h2>
        <NuxtLink to="/profil/modifier-informations">
            <div class="update">
                <img src="/img/icon-pencil.svg" alt="un crayon à papier">
                <p>Modifier vos informations</p>
            </div>
        </NuxtLink>
        <div class="logout">
            <img src="/img/icon-logout.svg" alt="une fleche qui sort d'un rectangle">
            <p>Se déconnecter</p>
        </div>
        <NuxtLink to="/profil/supprimer-compte">
            <div class="delete">
                <img src="/img/icon-delete.svg" alt="un profil avec une croix dans le coin droit">
                <p> Supprimer votre compte</p>
            </div>
        </NuxtLink>
    </div>
</template>

<style scoped lang="scss">
@import 'assets/base/colors';
h2{
    margin: 40px 0 60px 0;

}
.update, .delete, .logout{
    display: flex;
    align-items: center;
    margin: 20px 0;
    padding: 15px 10px;
    background-color: $beigeclair;
    box-shadow: 0 0 30px 0 rgba(0, 0, 0, 0.3);
    img{
        width: 20px;
        height: auto;
        margin-right: 15px;
    }
}
</style>