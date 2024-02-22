<template>
    <div>
        <div class="deco">
            <button>Déconnexion</button>
        </div>
    </div>
</template>

<style lang="scss">
@import 'assets/base/colors';

.deco {
    text-align: center;
    margin: 10px;    
    button {
    background-color: $darkgray;
    color: white;
    padding: 5px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 50%;
    opacity: 0.9;
    border-radius: 5px;
    }
}
</style>