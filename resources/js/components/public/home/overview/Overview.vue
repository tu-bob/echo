<template>
    <div class="container">
        <div class="row page-header">
            <h1 class="">Главная</h1>
        </div>

        <!-- top music -->
        <section class="row">
            <div class="section-header">
                <h2 class="section-title">Слушайте</h2>
                <router-link :to="{name: 'music'}" class="more-btn">
                    <span>больше музыки</span>
                </router-link>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <songs-list :playlist="songs.slice(0, Math.ceil(songs.length/2))"
                                no-fetch
                                prevent-play
                                @play="playSong"
                                class="px-3"
                                :class="{'col-md-6':songs.length > 1, 'col-12':songs.length < 2}">
                    </songs-list>
                    <songs-list :playlist="songs.slice(Math.ceil(songs.length/2))"
                                no-fetch
                                prevent-play
                                @play="playSong"
                                class="col-md-6 px-3">
                    </songs-list>
                </div>
            </div>
        </section>

        <!-- top albums -->
        <section class="row">
            <div class="section-header">
                <h2 class="section-title">Исследуйте</h2>
                <router-link :to="{name:'albums'}" class="more-btn">
                    <span>больше альбомов</span>
                </router-link>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <albums-list class="col-12" :provided-albums="albums" no-fetch></albums-list>
                </div>
            </div>
        </section>

        <!-- top videos -->
        <section class="row">
            <div class="section-header">
                <h2 class="section-title">Смотрите</h2>
                <router-link :to="{name:'clips'}" class="more-btn">
                    <span>больше клипов</span>
                </router-link>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <videos-list class="col-12" :provided-videos="videos" no-fetch></videos-list>
                </div>
            </div>
        </section>

        <!-- top albums -->
        <section class="row">
            <div class="section-header">
                <h2 class="section-title">Читайте</h2>
                <router-link :to="{name:'blog'}" class="more-btn">
                    <span>больше статей</span>
                </router-link>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <posts-list class="col-12" :provided-posts="posts" no-fetch></posts-list>
                </div>
            </div>
        </section>
    </div>

</template>

<script>
    import AlbumsList from "../../../common/music/album/AlbumsList";
    import {fetchAlbums, fetchSongs, fetchVideos} from "../../../../api/mediaApi";
    import SongsList from "../../../common/music/song/SongsList";
    import VideosList from "../../../common/video/VideosList";
    import PostsList from "../../blog/PostsList";
    import {fetchPosts} from "../../../../api/blogApi";
    import AxiosCancellationMixin from "../../../admin/mixins/AxiosCancellationMixin";
    import MetaTagsMixin from "../../../admin/mixins/MetaTagsMixin";

    export default {
        name: "Overview",
        mixins: [AxiosCancellationMixin, MetaTagsMixin],
        mounted() {
            this.fetchTopSongs();
            this.fetchTopAlbums();
            this.fetchTopVideos();
            this.fetchTopPosts();
        },
        data() {
            return {
                songs: [],
                albums: [],
                videos: [],
                posts: []
            }
        },
        components: {PostsList, VideosList, SongsList, AlbumsList},
        methods: {
            fetchTopSongs() {
                fetchSongs({order: 'random', limit: 12},
                    {cancelToken: this.getCancellationToken()}
                )
                    .then(songs => this.songs = songs)
                    .catch()
            },
            fetchTopAlbums() {
                fetchAlbums({order: 'random', limit: 12, songs: 1},
                    {cancelToken: this.getCancellationToken()}
                )
                    .then(albums => this.albums = albums)
                    .catch()
            },
            fetchTopVideos() {
                fetchVideos({order: 'random', limit: 12},
                    {cancelToken: this.getCancellationToken()}
                )
                    .then(videos => this.videos = videos)
                    .catch()
            },
            fetchTopPosts() {
                fetchPosts({order: 'random', limit: 12},
                    {cancelToken: this.getCancellationToken()}
                )
                    .then(posts => this.posts = posts)
                    .catch()
            },
            playSong(song) {
                this.$store.commit('UPDATE_PLAYLIST', this.songs);
                this.$store.commit('SET_ACTIVE_SONG', song);
            }
            // updatePlaylist() {
            //     this.$store.commit('UPDATE_PLAYLIST', this.songs);
            // }
        }
    }

</script>

<style scoped>
</style>
