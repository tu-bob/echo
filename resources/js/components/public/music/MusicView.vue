<template>
    <div class="container">
        <songs-list>

        </songs-list>
    </div>
</template>

<script>

    import SongsList from "../../common/music/song/SongsList";

    export default {
        name: "MusicView",
        components: {SongsList}
    }
</script>

<style scoped>

</style>
