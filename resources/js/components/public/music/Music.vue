<template>
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1 class="col-12">Песни</h1>
                <router-link class="col-12 ml-auto mb-3 mr-2" :to="{name:'genres'}">выбрать жанр</router-link>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <songs-list :filters="filters"></songs-list>
            </div>
        </div>
    </div>
</template>

<script>

    import SongsList from "../../common/music/song/SongsList";
    import MetaTagsMixin from "../../admin/mixins/MetaTagsMixin";

    export default {
        name: "Music",
        components: {SongsList},
        props: {
            genres: String
        },
        data() {
            return {
                title: 'Echo.tj - Музыка Таджикистана',
                description: 'Слушайте музыку онлайн или скачивайте в хорошем качестве с заполнеными метатегами.' +
                    'Находите тексты песен и аккорды. Любимые таджикские исполнители, песни и альбомы на портале' +
                    'Echo.tj'
            }
        },
        mixins: [MetaTagsMixin],
        computed: {
            filters() {
                return this.genres ? {'filter[genres.id]': this.genres} : {};
            }
        }
    }
</script>

<style scoped>

</style>
