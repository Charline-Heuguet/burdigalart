<template>
    <div>
<!-- VERSION JU -->

        <div class="accordion">

            <div class="accordion-item">
                <div class="accordion-title" @click="toggleContent">
                    <h3>Titre 1</h3>
                </div>
                <div class="accordion-content">
                    <p>Contenu 1</p>
                </div>
            </div>

            <div class="accordion-item">
                <div class="accordion-title" @click="toggleContent">
                    <h3>Titre 2</h3>
                </div>
                <div class="accordion-content">
                    <p>Contenu 2</p>
                </div>
            </div>

            <div class="accordion-item">
                <div class="accordion-title" @click="toggleContent">
                    <h3>Titre 3</h3>
                </div>
                <div class="accordion-content">
                    <p>Contenu 3</p>
                </div>
            </div>

        </div>
    </div>
</template>

<script setup>

const isActive = ref(false);

const toggleContent = (event) => {
    document.querySelectorAll('.accordion-item').forEach(item => {
        if (item !== event.target.parentElement) {
            item.classList.remove('active');
        }
    });
    const el = event.target.parentElement.parentElement;
    el.classList.toggle('active');
};
</script>

<style scoped lang="scss">
.accordion-item{
    .accordion-content {
        display: none;
    }
    &.active {
        .accordion-content {
            display: block;
        }
    }
}

</style>