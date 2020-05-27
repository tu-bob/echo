<template>
    <div>
        <albums-list></albums-list>
    </div>
</template>

<script>
    import AlbumsList from "../../common/music/album/AlbumsList";
    import MetaTagsMixin from "../../admin/mixins/MetaTagsMixin";

    export default {
        name: "AlbumsView",
        data() {
            return {
                title: 'Echo.tj - Главные музыкальные альбомы Таджикистана',
                description: 'Музыкальные альбомы таджикских групп и артистов в высоком качестве на Echo.tj. ' +
                    'На сайте доступны альбомы Далера Назарова, гр. Парем и многих других известных артистов.'
            }
        },
        mixins: [MetaTagsMixin],
        components: {
            AlbumsList
        }
    }
</script>

<style scoped>

</style>
