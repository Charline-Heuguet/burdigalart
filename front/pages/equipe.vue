<template>
    <div>
        <h1>Ils ont fait Burdigal'Art</h1>
        <!-- Enola -->
        <div class="main">
            <div class="card">
                <img src="/img/enola.jpeg" alt="">
                <h2>Enola Monai - Web Marketing</h2>
                <a href="https://www.linkedin.com/in/enola-monai-b014621b8/" class="linkedin-icon">
                    <img src="/img/icon-lkdn.svg" alt="linkedin">
                </a>
                <p>Enola Monai, étudiante en Bachelor Webmarketing & Social Media mais surtout passionnée par ce projet
                    nommé Burdigal’art. <br> Un projet né d’une équipe dévouée et surtout d’une idée
                    flamboyante.<br>L’essence même de ce concept est la cohésion, la passion et bien évidemment l’envie de
                    vous faire découvrir de nouvelles personnalités à travers l’univers Burdigal’art !
                </p>
            </div>
        </div>
        <!-- Armand -->
        <div class="main">
            <div class="card">
                <img src="/medias/armand.jpeg" alt="">
                <h2>Armand Pelletier - Web Marketing</h2>
                <a href="https://www.linkedin.com/in/armand-pelletier-0b6796262/" class="linkedin-icon">
                    <img src="/img/icon-lkdn.svg" alt="linkedin">
                </a>
                <p>Passionné par les mondes imaginaires depuis ma jeunesse, j'ai toujours cru en la puissance des histoires
                    et en la beauté du livre. Mon parcours a été marqué par la fusion de cette passion avec mes compétences
                    en communication et événementiel.J'ai exploré ma passion pour le cinéma et l'audiovisuel, consolidant
                    mes compétences grâce à une option cinéma audiovisuel et un BTS montage et post-production.
                </p>
            </div>
        </div>
        <!-- Charline -->
        <div class="main">
            <div class="card">
                <img src="/medias/charline.png" alt="">
                <h2>Charline Heuguet - Web Développeuse</h2>
                <a href="https://www.linkedin.com/in/charline-heuguet/" class="linkedin-icon">
                    <img src="/img/icon-lkdn.svg" alt="linkedin">
                </a>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita natus itaque quidem nobis fuga accusamus tenetur? Cumque, exercitationem. Vel, ipsum atque consequatur velit officiis nam facere natus voluptate autem eos!
                </p>
            </div>
        </div>
        <!-- Anthony -->
        <div class="main">
            <div class="card">
                <img src="/medias/anthony.png" alt="">
                <h2>Anthony Labrit - Web Marketing</h2>
                <a href="https://www.linkedin.com/in/anthony-l-a35072266/" class="linkedin-icon">
                    <img src="/img/icon-lkdn.svg" alt="linkedin">
                </a>
                <p>Sportif assidu, passionné d’entrepreneuriat et de création, je produis un Podcast qui vise à découvrir des personnes aussi passionnantes qu’inspirantes. Au Coin de ta Rue a pour objectif de mettre en avant les commerces de proximité et découvrir les histoires des personnes qui en sont à l’origine.
                </p>
            </div>
        </div>
        <!-- Fanny -->
        <div class="main">
            <div class="card">
                <img src="/medias/fanny.jpeg" alt="">
                <h2>Fanny Razanadrasamy - <br> Web Marketing</h2>
                <a href="https://www.linkedin.com/in/fanny-razanadrasamy-b34542196/" class="linkedin-icon">
                    <img src="/img/icon-lkdn.svg" alt="linkedin">
                </a>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis ipsa vitae laborum nesciunt excepturi molestias aspernatur architecto quae labore repellat commodi quisquam culpa, quo cumque veniam suscipit optio, dolorum expedita!
                </p>
            </div>
        </div>

    </div>
</template>

<style scoped lang="scss">
.main {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 20px;
    font-family: 'Roboto', sans-serif;
}

.card {
    position: relative;
    width: 24rem;
    height: 28rem;
    border-radius: 10px;
    overflow: hidden;
    cursor: pointer;
    color: black;
    box-shadow: 0 10px 30px 5px rgba(0, 0, 0, 0.2);
    transition: transform .3s ease-out;

    .linkedin-icon {
        position: absolute;
        top: 10px;
        left: 10px;
        width: 30px;
        height: 30px;
        z-index: 10;
        opacity: 1;
        display: block;
    }


    img {
        position: absolute;
        object-fit: cover;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        transition: opacity .2s ease-out, filter .3s ease-out;
    }

    h2 {
        backdrop-filter: blur(10px);
        background-color: rgba(128, 128, 128, 0.424);
        color: rgb(233, 231, 231);
        position: absolute;
        inset: auto 20px 10px 20px;
        font-weight: normal;
        font-size: 1.2rem;
        letter-spacing: 0.05em;
        border-radius: 50px;
        text-align: center;
        z-index: 10;
        padding: 10px;
    }

    p {
        position: absolute;
        opacity: 0;
        max-width: 80%;
        inset: 40px auto auto 30px;
        z-index: 10;
        line-height: 1.7em;
    }

    a {
        position: absolute;
        opacity: 0;
        inset: auto auto 40px 30px;
        color: inherit;
        text-decoration: none;
        z-index: 10;
    }

    &:hover>img {
        filter: blur(20px);
        opacity: 0.5;
    }

    &:hover p,
    &:hover a {
        opacity: 1;
        transition: opacity .5s .1s ease-in;
    }
}

@media (min-width: 768px) {
    .card {
        height: 36rem; // Hauteur originale pour les tablettes et les desktops
    }
}</style>