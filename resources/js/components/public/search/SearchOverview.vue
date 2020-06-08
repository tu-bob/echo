<template>
    <b-container fluid>
        <b-overlay :show="busy" rounded="sm" variant="dark" no-wrap></b-overlay>
        <b-input-group prepend="Поиск" class="mt-3 mb-5">
            <input @keydown.enter="search"
                   type="text"
                   class="form-control bg-dark text-white border-secondary"
                   v-model="query">
            <b-input-group-append>
                <b-button variant="secondary" @click="search">Найти</b-button>
            </b-input-group-append>
        </b-input-group>

        <section class="section" v-if="artists.length > 0">
            <h2 class="title">Исполнители</h2>
            <div>
                <artists-view :providedArtists="artists" no-fetch></artists-view>
            </div>
        </section>

        <section class="section" v-if="songs.length > 0">
            <h2 class="title">Песни</h2>
            <div class="row">
                <songs-list :playlist="songs.slice(0, Math.ceil(songs.length/2))"
                            @play="updatePlaylist"
                            no-fetch
                            :class="{'col-md-6':songs.length > 1, 'col-12':songs.length < 2}"></songs-list>
                <songs-list :playlist="songs.slice(Math.ceil(songs.length/2))"
                            @play="updatePlaylist"
                            no-fetch
                            class="col-md-6"></songs-list>
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

        <section class="section" v-if="posts.length > 0">
            <h2 class="title">Статьи</h2>
            <posts-list :provided-posts="posts" no-fetch></posts-list>
        </section>
    </b-container>
</template>

<script>
    import {search} from "../../../api/mediaApi";
    import AlbumsList from "../../common/music/album/AlbumsList";
    import SongsList from "../../common/music/song/SongsList";
    import VideosList from "../../common/video/VideosList";
    import {search as blogSearch} from "../../../api/blogApi";
    import PostsList from "../blog/PostsList";
    import ArtistsView from "../artist/ArtistsList";


    export default {
        name: "SearchOverview",
        components: {ArtistsView, PostsList, VideosList, AlbumsList, SongsList},
        data() {
            return {
                query: '',
                songs: [],
                videos: [],
                albums: [],
                artists: [],
                posts: [],
                busy: false
            }
        },
        methods: {
            search() {
                this.busy = true;
                this.clearForm()
                search(this.query)
                    .then(response => {
                        this.songs = response.songs;
                        this.albums = response.albums;
                        this.videos = response.videos;
                        this.artists = response.artists;
                    })
                    .catch()
                    .finally(_ => this.busy = false);

                blogSearch(this.query)
                    .then(response => {
                        this.posts = response.posts;
                    })
                    .catch()
            },
            updatePlaylist() {
                this.$store.commit('UPDATE_PLAYLIST', this.songs);
            },
            clearForm() {
                this.songs = [];
                this.videos = [];
                this.albums = [];
                this.artists = [];
                this.posts = [];
            }
        }
    }
</script>

<style scoped>

</style>
