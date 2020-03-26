<template>
    <carousel :nav="false" :dots="false" :responsive="{0:{items:1},540:{items:2},720:{items:3},1200:{items:4}}">
        <div>
            <song-card></song-card>
            <song-card></song-card>
            <song-card></song-card>
            <song-card></song-card>
        </div>
        <div>
            <song-card></song-card>
            <song-card></song-card>
            <song-card></song-card>
            <song-card></song-card>
        </div>
        <div>
            <song-card></song-card>
            <song-card></song-card>
            <song-card></song-card>
            <song-card></song-card>
        </div>
        <div>
            <song-card></song-card>
            <song-card></song-card>
            <song-card></song-card>
            <song-card></song-card>
        </div>
    </carousel>
</template>

<script>
    import SongCard from "./SongCard";
    import Carousel from 'vue-owl-carousel'

    export default {
        name: "SongsCarousel",
        components: {SongCard, Carousel}
    }
</script>

<style scoped>

</style>
