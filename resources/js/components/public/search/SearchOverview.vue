<template>
    <b-overlay :show="busy" rounded="sm" variant="dark">
        <b-input-group prepend="Поиск" class="mt-3 mb-5">
            <input @keydown.enter="search"
                   type="text"
                   class="form-control bg-dark text-white border-secondary"
                   v-model="query">
            <b-input-group-append>
                <b-button variant="secondary" @click="search">Найти</b-button>
            </b-input-group-append>
        </b-input-group>

        <section class="section" v-if="songs.length > 0">
            <h2 class="title">Песни</h2>
            <div class="row">
                <songs-list :playlist="songs.slice(0, Math.ceil(songs.length/2))" no-fetch
                            class="col-md-6"></songs-list>
                <songs-list :playlist="songs.slice(Math.ceil(songs.length/2))" no-fetch class="col-md-6"></songs-list>
            </div>
        </section>

        <section class="section" v-if="albums.length > 0">
            <h2 class="title">Альбомы</h2>
            <albums-list :provided-albums="albums" no-fetch></albums-list>
        </section>

        <section class="section" v-if="videos.length > 0">
            <h2 class="title">Видео</h2>
            <videos-list :provided-videos="videos" no-fetch></videos-list>
        </section>
    </b-overlay>
</template>

<script>
    import {search} from "../../../api/mediaApi";
    import AlbumsList from "../../common/music/album/AlbumsList";
    import SongsList from "../../common/music/song/SongsList";
    import VideosList from "../../common/video/VideosList";


    export default {
        name: "SearchOverview",
        components: {VideosList, AlbumsList, SongsList},
        data() {
            return {
                query: '',
                songs: [],
                videos: [],
                albums: [],
                busy: false
            }
        },
        methods: {
            search() {
                this.busy = true;
                search(this.query)
                    .then(response => {
                        this.songs = response.songs;
                        this.albums = response.albums;
                        this.videos = response.videos;
                    })
                    .catch()
                    .then(_ => this.busy = false)
            }
        }
    }
</script>

<style scoped>

</style>
