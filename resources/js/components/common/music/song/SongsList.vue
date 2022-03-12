<template>
    <div class="container-fluid px-0">
        <song-card v-for="song in songs" :song="song" :key="song.id"
                   @play="playSong"></song-card>
        <pagination v-if="pagination && !noFetch"
                    ref="songs-list-pagination"
                    flow
                    :pagination="pagination"
                    class="mt-5"
                    @pageChanged="fetchSongs"
                    v-observe-visibility="paginationIntersObj"></pagination>
    </div>
</template>

<script>
    import {fetchSongs} from "../../../../api/mediaApi";
    import AxiosCancellationMixin from "../../../admin/mixins/AxiosCancellationMixin";
    import SongCard from "./SongCard";
    import Pagination from "../../inputs/Pagination";

    export default {
        name: "SongsList",
        components: {Pagination, SongCard},
        mixins: [AxiosCancellationMixin],
        mounted() {
            if (this.playlist)
                this.songs = this.playlist;
            else if (!this.noFetch)
                this.fetchSongs()
        },
        props: {
            playlist: null,
            noFetch: Boolean,
            preventPlay: Boolean,
            filters: {
                type: Object,
                default: () => {
                }
            }
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
                        rootMargin: '150px',
                        throttle: 100
                    }
                }
            }
        },
        methods: {
            fetchSongs(page = 1) {
                this.isFetchingSongs = true;
                fetchSongs({...{order: 'latest', page: page, paginate: 15}, ...this.filters},
                    {cancelToken: this.getCancellationToken()}
                )
                    .then(response => {
                        this.pagination = response;
                        this.songs.push(...response.data);
                    })
                    .catch()
                    .finally(_ => {
                        this.isFetchingSongs = false;
                        this.$refs['songs-list-pagination'].loaded()
                    })
            },
            playSong(song) {
                if (this.preventPlay)
                    return this.$emit('play', song);
                if (song) {
                    this.$store.commit('UPDATE_PLAYLIST', this.songs);
                    this.$store.commit('SET_ACTIVE_SONG', song);
                }
            },
            paginationVisibilityChanged(isVisible, entry) {
                let btn = entry.target.querySelector('button');
                if (isVisible && !this.isFetchingSongs && btn)
                    btn.click()
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
