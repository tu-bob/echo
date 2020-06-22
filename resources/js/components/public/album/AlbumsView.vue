<template>
    <div class="container">
        <div class="row page-header">
            <h1>Альбомы</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <albums-list></albums-list>
            </div>
        </div>
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
