<template>
    <div class="text-white">
        <div class="h-overlay-container cursor-pointer" @click="play" title="Послушать альбом">
            <!--            <b-img class="album-cover" @error="onCoverLoadError" blankColor="#a892f8cf" :blank="coverLoadFailed" rounded-->
            <!--                   :src="coverUrl" alt=""></b-img>-->
            <safe-image :src="coverUrl" class="album-cover" fallback-blank rounded></safe-image>
            <div class="h-overlay d-flex align-items-center">
                <div class="btn btn-light mx-auto">
                    <img class="icon-btn-xl" src="/icons/svg/play-btn-light.svg">
                </div>
            </div>
        </div>

        <router-link class="text-decoration-none text-white" :to="{name: 'album-view', params:{id: album.id}}">
            <h5 class="mt-3 mb-0 cursor-pointer" title="Перейти к альбому">{{album.title}} <span
                v-if="album.type && album.type.name === 'Single album'">- Сингл</span></h5>
            <span class="text-muted">{{artists}}</span>
        </router-link>
    </div>
</template>

<script>
    import {
        fetchAlbumSongs,
        getAlbumCoverUrl,
        increaseMediaCount
    } from "../../../../api/mediaApi";
    import {concatStrings} from "../../../../util/stringHelper";
    import SafeImage from "../../image/SafeImage";

    export default {
        name: "AlbumCard",
        components: {SafeImage},
        props: {
            album: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                songs: [],
                coverLoadFailed: false
            }
        },
        methods: {
            onCoverLoadError(e) {
                this.coverLoadFailed = true;
            },
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
                    increaseMediaCount(this.album.id, 'album', 'play');
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
