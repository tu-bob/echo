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
                <songs-list :playlist="songs.slice(0, Math.ceil(songs.length/2))"
                            no-fetch
                            class="col-md-6" @play="updatePlaylist"></songs-list>
                <songs-list :playlist="songs.slice(Math.ceil(songs.length/2))"
                            no-fetch
                            @play="updatePlaylist"
                            class="col-md-6"></songs-list>
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
            <albums-list :provided-albums="albums" no-fetch></albums-list>
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
            <videos-list :provided-videos="videos" no-fetch></videos-list>
        </section>
        <section class="section col-12">
            <div class="row">
                <h2 class="col-8 title">Свежие статьи</h2>
                <div class="col-4 text-right">
                    <router-link :to="{name:'blog'}" class="ml-auto btn-text-white text-decoration-none">
                        <span>больше статей</span>
                    </router-link>
                </div>
            </div>
            <posts-list :provided-posts="posts" no-fetch></posts-list>
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

    export default {
        name: "Overview",
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
                fetchSongs({order: 'play_count:desc,download_count:desc', limit: 8})
                    .then(songs => this.songs = songs)
                    .catch()
            },
            fetchTopAlbums() {
                fetchAlbums({order: 'play_count:desc,download_count:desc', limit: 8, songs: 1})
                    .then(albums => this.albums = albums)
                    .catch()
            },
            fetchTopVideos() {
                fetchVideos({order: 'play_count:desc,download_count:desc', limit: 8})
                    .then(videos => this.videos = videos)
                    .catch()
            },
            fetchTopPosts() {
                fetchPosts({order: 'view_count:desc', limit: 4})
                    .then(posts => this.posts = posts)
                    .catch()
            },
            updatePlaylist() {
                this.$store.commit('UPDATE_PLAYLIST', this.songs);
            }
        }
    }

</script>

<style scoped>
</style>
