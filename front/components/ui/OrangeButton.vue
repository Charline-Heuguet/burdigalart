<template>
    <div class="button-link">
        <slot></slot>
    </div>
</template>
<style scoped lang="scss">
@import 'assets/base/colors';

.button-link {
    background-color: $mandarin;
    color: white;
    border: none;
    padding: 15px 20px;
    border-radius: 5px;
    font-size: 20px;
    margin: 20px 0;
    cursor: pointer;
    width: 100%;
    display: block;
    text-align: center;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 1px;
    border: 2px solid darken($mandarin, 5%);
    text-shadow: 2px 2px 0px darken($mandarin, 15%);
}
</style>