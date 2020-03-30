<template>
    <div>
        <song-card v-for="song in songs" :song="song" :key="song.id" @play="playSong"></song-card>
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
            this.fetchSongs()
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
        }
    }
</script>

<style scoped>

</style>
