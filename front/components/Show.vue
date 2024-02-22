<template>
    <div class="show">
        <img src="/medias/artistShowPicture.jpg" alt="affiche du spectacle">
        <div class="nom-show">
            <h1>Nom de l'artiste - </h1>
            <p>Titre du show</p>
        </div>
        <div class="description">
            <NuxtLink class="line-clamp-3 " to="/">
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Recusandae, non deleniti. Quae, quos! Nobis alias,
                rerum sed ipsam incidunt earum facere, nam cupiditate quae blanditiis id aspernatur, necessitatibus eum quo?</p>
            </NuxtLink>
        </div>
        
    </div>
</template>

<style scoped lang="scss">
.show {
    border: 1px solid black;

    .nom-show {
        display: flex;
        justify-content: center;
        margin: 20px 0;
    }
    .description {
        margin: 20px 0;
        padding: 0 20px;
    }

}

</style>