<template>
    <div>
        <img src="/medias/artistShowPicture.jpg" alt="affiche du spectacle">
        <div class="name-title">
            <h1>Nom de l'artiste - </h1>
            <p>Titre du show</p>
        </div>
        <p class="description">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos quod corrupti enim dolore consequuntur dolorem ea,
            iure magni quibusdam quae temporibus nihil laborum libero. Eos possimus blanditiis voluptatem distinctio
            perferendis!
        </p>
        <NuxtLink to="/artiste/artistName">
        </NuxtLink>
    </div>
</template>
<style scoped lang="scss">
.name-title{
    display: flex;
    justify-content: center;
    margin-top: 20px;
    margin-bottom: 20px;    
}

.info {
    display: flex;
    align-items: center;

    img {
        width: 30px;
        height: 30px;
        margin-right: 20px;
        margin-top: 5px;
    }
}

.description {
    margin: 20px 0;
}
</style>