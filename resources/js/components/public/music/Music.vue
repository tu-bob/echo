<template>
    <div>
        <div class="d-flex">
            <router-link class="ml-auto mb-3 mr-2" :to="{name:'genres'}">Посмотреть жанры</router-link>
        </div>
        <songs-list :filters="filters"></songs-list>
    </div>
</template>

<script>

    import SongsList from "../../common/music/song/SongsList";
    import TitleMixin from "../../admin/mixins/TitleMixin";

    export default {
        name: "Music",
        components: {SongsList},
        props: {
            genres: String
        },
        data() {
            return {
                title: 'Echo.tj - Музыка Таджикистана'
            }
        },
        mixins: [TitleMixin],
        computed: {
            filters() {
                return this.genres ? {genres: this.genres} : {};
            }
        }
    }
</script>

<style scoped>

</style>
