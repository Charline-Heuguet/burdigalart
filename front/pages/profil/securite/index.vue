<template>
    <div class="security">
        <img src="/img/icon-padlock.svg" alt="cadenas fermé">
        <h2>Espace sécurité</h2>
    </div>
    <section class="password">
        <h3>Vous désirez changer votre mot de passe ?</h3>
        <p>Une fois votre mot de passe changé, vous devrez vous reconnecter</p>
        <NuxtLink>Changer mon mot de passe</NuxtLink>
    </section>
    <section class="delete-account">
        <h3>Vous désirez supprimer votre compte ?</h3>
        <p>Attention, cette action est irréversible</p>
        <NuxtLink>
            <button class="delete">Supprimer mon compte</button>
        </NuxtLink>
    </section>
</template>

<style scoped lang="scss">
.security {
    display: flex;
    align-items: center;
    justify-content: center;
    h2{
        margin-bottom: 0;
    }
    img {
        width: 50px;
        height: 50px;
        margin-right: 10px;
    }
}

.delete-account {
    margin-top: 50px;
    h3 {
        margin-bottom: 0;
    }
    p {
        margin-top: 0;
    }
    button {
        background-color: red;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }
}

</style>