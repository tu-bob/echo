<template>
    <div class="text-white">
        <b-img class="album-cover" rounded :src="imageSrc" alt=""></b-img>

        <h5 class="mt-3 mb-0">Сон с летнем сдау</h5>
        <span class="text-muted">Далер Назаров</span>
    </div>
</template>

<script>
    export default {
        name: "AlbumCard",
        props: {
            imageSrc: {
                default: 'https://draw.acharts.net/cover/60742-54d01316f35c2-l.jpg'
            }
        }
    }
</script>

<style scoped>
    .album-cover {
        object-fit: cover;
        width: 100% !important;
        height: 218px;
    }
</style>
