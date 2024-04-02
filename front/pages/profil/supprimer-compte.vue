<template>
    <div>
        <h2>Supprimer mon compte</h2>
        <p>Attention, cette action est irréversible.</p>
        <p>Votre compte sera d'abord désactivé puis toutes vos données seront supprimées au bout de 30 jours.</p>
        <p>Si vous rencontrez un quelconque problème, merci de nous contacter.</p>
        <div class="button-delete">
            <button>Supprimer mon compte</button>
        </div>
    </div>
</template>
<style lang="scss" scoped>
p {
    margin-bottom: 20px;
}
.button-delete{
    display: flex;
    justify-content: center;
}
button {
    display: flex;
    justify-content: center;
    background-color: red;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 20px;
}
</style>