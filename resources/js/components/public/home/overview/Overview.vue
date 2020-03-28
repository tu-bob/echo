<template>
    <div>
<!--        <songs-carousel></songs-carousel>-->
        <hr>
        <albums-list></albums-list>
    </div>

</template>

<script>
    import SongsCarousel from "../../../common/music/song/SongsСarousel";
    import AlbumsList from "../../../common/music/album/AlbumsList";

    export default {
        name: "Overview",
        components: {AlbumsList, SongsCarousel}
    }

</script>
