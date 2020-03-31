<template>
    <div>
        <song-card class="cursor-pointer" v-for="song in songs" :song="song" :key="song.id"
                   @play="playSong"></song-card>
    </div>
</template>

<script>
    import {fetchSongs} from "../../../../api/mediaApi";
    import SongCard from "./SongCard";
    import {mapGetters} from "vuex";

    export default {
        name: "SongsList",
        components: {SongCard},
        created() {
            if (this.playlist)
                this.songs = this.playlist;
            else
                this.fetchSongs()
        },
        props: {
            playlist: null
        },
        data() {
            return {
                paginator: null,
                songs: []
            }
        },
        methods: {
            fetchSongs(page = 1) {
                fetchSongs({order: 'latest', page: page, paginate: 15})
                    .then(response => {
                        this.paginator = response;
                        this.songs.push(...response.data);
                    })
                    .catch()
            },
            playSong(song) {
                if (song) {
                    this.$store.commit('UPDATE_PLAYLIST', this.songs);
                    this.$store.commit('SET_ACTIVE_SONG', song);
                }
            }
        },
        watch: {
            playlist() {
                if (this.playlist)
                    this.songs = this.playlist;
            }
        }
    }
</script>

<style scoped>

</style>
