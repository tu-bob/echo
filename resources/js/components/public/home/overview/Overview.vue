<template>
    <div>
        <songs-carousel></songs-carousel>
        <hr>
        <albums-viewer></albums-viewer>
    </div>

</template>

<script>
    import SongsCarousel from "../../../common/music/song/SongsCarousel";
    import AlbumsViewer from "../../../common/music/album/AlbumsViewer";

    export default {
        name: "Overview",
        components: {AlbumsViewer, SongsCarousel}
    }

</script>
