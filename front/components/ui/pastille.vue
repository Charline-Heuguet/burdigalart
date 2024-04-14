<template>
    <div class="pastille">
        <slot />    
    </div>
</template>

<style scoped lang="scss">
.pastille {
    display: inline-block;
    text-align: center;
    padding: 5px 10px;
    border-radius: 100px;
    background-color: #f1f1f1;
    color: #333;
    font-size: 12px;
    text-transform: uppercase;
}
</style>