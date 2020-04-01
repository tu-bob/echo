<template>
    <div class="text-white">
        <div class="h-overlay-container cursor-pointer" @click="play">
            <b-img class="album-cover" rounded :src="coverUrl" alt=""></b-img>
            <div class="bg-violet-gradient h-overlay d-flex align-items-center">
                <div class="btn btn-light mx-auto">
                    <img class="icon-btn-xl" src="/icons/svg/play-btn-light.svg">
                </div>
            </div>
        </div>


        <h5 class="mt-3 mb-0">{{album.title}}</h5>
        <span class="text-muted">{{artists}}</span>
    </div>
</template>

<script>
    import {
        fetchAlbumSongs,
        getAlbumCoverUrl,
        increaseMediaCount,
        increaseMediaPlayCount
    } from "../../../../api/mediaApi";
    import {concatStrings} from "../../../../util/stringHelper";

    export default {
        name: "AlbumCard",
        props: {
            album: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                songs: []
            }
        },
        methods: {
            async play() {
                if (this.songs.length === 0)
                    await fetchAlbumSongs(this.album.id)
                        .then(response => {
                            this.songs.push(...response);
                        })
                        .catch();
                if (this.songs.length > 0) {
                    this.$store.commit('UPDATE_PLAYLIST', this.songs);
                    this.$store.commit('SET_ACTIVE_SONG', this.songs[0]);
                    increaseMediaCount(this.album.id, 'album', 'view');
                }
            }
        },
        computed: {
            coverUrl() {
                return getAlbumCoverUrl(this.album.id)
            },
            artists() {
                if (this.album.artistAliases && this.album.artistAliases.length > 0) {
                    let artists = concatStrings(this.album.artistAliases.map(alias => alias.name).slice(0, 2), ', ');
                    if (this.album.artistAliases.length > 2)
                        artists += ' . . .';
                    return artists;
                }
                return "Альбом пустой"
            }
        }
    }
</script>

<style scoped>
    .album-cover {
        object-fit: cover;
        width: 100% !important;
        height: 218px;
    }
</style>
