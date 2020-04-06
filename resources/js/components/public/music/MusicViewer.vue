<template>
    <div class="">
        <router-view></router-view>
    </div>
</template>

<script>

    import SongsList from "../../common/music/song/SongsList";

    export default {
        name: "MusicViewer",
        components: {SongsList}
    }
</script>

<style scoped>

</style>
