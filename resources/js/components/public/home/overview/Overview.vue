<template>
    <div>
        <section class="section col-12">
            <div class="row">
                <h2 class="col-8 title">Музыка достойная вас</h2>
                <div class="col-4 text-right">
                    <router-link :to="{name: 'music'}" class="ml-auto btn-text-white text-decoration-none">
                        <span>больше музыки</span>
                    </router-link>
                </div>
            </div>
            <div class="row">
                <songs-list :playlist="songs.slice(0, Math.ceil(songs.length/2))" no-fetch
                            class="col-md-6"></songs-list>
                <songs-list :playlist="songs.slice(Math.ceil(songs.length/2))" no-fetch class="col-md-6"></songs-list>
            </div>
        </section>
        <section class="section col-12">
            <div class="row">
                <h2 class="col-8 title">Эти альбомы ждут вас</h2>
                <div class="col-4 text-right">
                    <router-link :to="{name:'albums'}" class="ml-auto btn-text-white text-decoration-none">
                        <span>больше альбомов</span>
                    </router-link>
                </div>
            </div>
            <albums-list></albums-list>
        </section>
        <section class="section col-12">
            <div class="row">
                <h2 class="col-8 title">Клипы, которые нельзя пропустить</h2>
                <div class="col-4 text-right">
                    <router-link :to="{name:'clips'}" class="ml-auto btn-text-white text-decoration-none">
                        <span>больше клипов</span>
                    </router-link>
                </div>
            </div>
            <videos-list></videos-list>
        </section>
    </div>

</template>

<script>
    import AlbumsList from "../../../common/music/album/AlbumsList";
    import {fetchSongs} from "../../../../api/mediaApi";
    import SongsList from "../../../common/music/song/SongsList";
    import VideosList from "../../../common/video/VideosList";

    export default {
        name: "Overview",
        mounted() {
            this.fetchTopSongs()
        },
        data() {
            return {
                songs: []
            }
        },
        components: {VideosList, SongsList, AlbumsList},
        methods: {
            fetchTopSongs() {
                fetchSongs({order: 'latest,play_count,download_count', limit: 8})
                    .then(songs => this.songs = songs)
                    .catch()
            }
        }
    }

</script>

<style scoped>
</style>
