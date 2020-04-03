<template>
    <div>
        <song-card class="cursor-pointer" v-for="song in songs" :song="song" :key="song.id"
                   @play="playSong"></song-card>
        <pagination v-if="pagination" flow :pagination="pagination" class="mt-5" @pageChanged="fetchSongs"></pagination>
    </div>
</template>

<script>
    import {fetchSongs} from "../../../../api/mediaApi";
    import SongCard from "./SongCard";
    import Pagination from "../../inputs/Pagination";

    export default {
        name: "SongsList",
        components: {Pagination, SongCard},
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
                pagination: null,
                songs: []
            }
        },
        methods: {
            fetchSongs(page = 1) {
                fetchSongs({order: 'latest', page: page, paginate: 5})
                    .then(response => {
                        this.pagination = response;
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
