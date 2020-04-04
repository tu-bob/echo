<template>
    <div>
        <songs-list :playlist="songs" no-fetch></songs-list>
        <hr>
        <albums-list></albums-list>
    </div>

</template>

<script>
    import AlbumsList from "../../../common/music/album/AlbumsList";
    import {fetchSongs} from "../../../../api/mediaApi";
    import SongsList from "../../../common/music/song/SongsList";

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
        components: {SongsList, AlbumsList},
        methods: {
            fetchTopSongs() {
                fetchSongs({order: 'latest,play_count,download_count', limit: 5})
                    .then(songs => this.songs = songs)
                    .catch()
            }
        }
    }

</script>
