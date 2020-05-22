<template>
    <div>
        <albums-list></albums-list>
    </div>
</template>

<script>
    import AlbumsList from "../../common/music/album/AlbumsList";
    import TitleMixin from "../../admin/mixins/TitleMixin";

    export default {
        name: "AlbumsView",
        data() {
            return {
                title: 'Echo.tj - Главные музыкальные альбомы Таджикистана'
            }
        },
        mixins: [TitleMixin],
        components: {
            AlbumsList
        }
    }
</script>

<style scoped>

</style>
