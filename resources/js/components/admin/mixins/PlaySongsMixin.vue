<template>

</template>

<script>
    import {increaseMediaCount} from "../../../api/mediaApi";

    export default {
        name: "PlaySongsMixin",
        methods: {
            playSongs(songs) {
                this.$store.commit('UPDATE_PLAYLIST', songs);
                this.$store.commit('SET_ACTIVE_SONG', songs[0]);
                increaseMediaCount(this.album.id, 'album', 'play');
            }
        }
    }
</script>

<style scoped>

</style>
