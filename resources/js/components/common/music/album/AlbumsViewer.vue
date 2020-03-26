<template>
    <div class="row">
        <album-card class="col-12 col-md-6 col-lg-4 col-xl-2"></album-card>
        <album-card class="col-12 col-md-6 col-lg-4 col-xl-2"></album-card>
        <album-card class="col-12 col-md-6 col-lg-4 col-xl-2"></album-card>
        <album-card class="col-12 col-md-6 col-lg-4 col-xl-2"></album-card>
        <album-card class="col-12 col-md-6 col-lg-4 col-xl-2"></album-card>
        <album-card class="col-12 col-md-6 col-lg-4 col-xl-2"></album-card>
    </div>
</template>

<script>
    import AlbumCard from "./AlbumCard";

    export default {
        name: "AlbumsViewer",
        components: {AlbumCard}
    }
</script>

<style scoped>

</style>
