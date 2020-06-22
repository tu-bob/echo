<template>
    <div class="container-fluid">
        <div class="row">
            <router-view></router-view>
        </div>
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
