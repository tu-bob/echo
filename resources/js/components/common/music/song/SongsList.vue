<template>
    <div>
        <song-card class="cursor-pointer" v-for="song in songs" :song="song" :key="song.id"
                   @play="playSong"></song-card>
        <pagination v-if="pagination"
                    flow
                    :pagination="pagination"
                    class="mt-5"
                    @pageChanged="fetchSongs"
                    v-observe-visibility="paginationIntersObj"></pagination>
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
                songs: [],
                isFetchingSongs: false,
                paginationIntersObj: {
                    callback: this.paginationVisibilityChanged,
                    intersection: {
                        threshold: 0.3,
                        rootMargin: '100px'
                    }
                }
            }
        },
        methods: {
            fetchSongs(page = 1) {
                fetchSongs({order: 'latest', page: page, paginate: 15})
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
            },
            paginationVisibilityChanged(isVisible, entry) {
                if (isVisible && !this.isFetchingSongs)
                    entry.target.querySelector('button').click()
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
