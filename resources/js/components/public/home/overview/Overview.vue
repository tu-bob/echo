<template>
    <div>
        <section class="mb-5">
            <h2 class="mb-5">Музыка достойная вас</h2>
            <div class="row">
                <songs-list :playlist="songs.slice(0, Math.ceil(songs.length/2))" no-fetch class="col-md-6"></songs-list>
                <songs-list :playlist="songs.slice(Math.ceil(songs.length/2))" no-fetch class="col-md-6"></songs-list>
            </div>
        </section>
        <section class="mb-5">
            <h2 class="mb-5">Прослушайте эти альбомы</h2>
            <albums-list></albums-list>
        </section>
        <section class="mb-5">
            <h2 class="mb-5">Лучшие клипы</h2>
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
    h2 {
        color: #6c757d;
        font-size: 1.4rem;
    }
</style>
