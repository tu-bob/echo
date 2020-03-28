<template>
    <div>
        <albums-list></albums-list>
    </div>
</template>

<script>
    import AlbumsList from "../../common/music/album/AlbumsList";

    export default {
        name: "AlbumsView",
        components: {
            AlbumsList
        }
    }
</script>

<style scoped>

</style>
