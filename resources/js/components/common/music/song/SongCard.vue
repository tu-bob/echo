<template>
    <div class="container mb-3 h-border-violet" :class="{active: ACTIVE_SONG && ACTIVE_SONG.id === song.id}">
        <div class="row w-100 text-white" @click="play">
            <img :src="coverUrl" class="thumb" @error="onImageError">
            <div class="ml-2 mt-2 row col">
                <div>
                    <h6 class="mb-0">{{song.title}}</h6>
                    <span class="text-muted">{{aliases}} </span>
                </div>
                <div class="ml-auto row">
                    <!--                    <span class="pr-4 text-muted">{{song.bitrate / 1000}} кбит/с</span>-->
                    <span>{{duration}}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {concatStrings, secondsToFormattedMinutes} from '../../../../util/stringHelper'
    import {getAlbumCoverUrl, getSongIconUrl} from "../../../../api/mediaApi";
    import {mapGetters} from "vuex";

    export default {
        name: "SongCard",
        props: {
            song: {
                type: Object,
                required: true
            },
            thumbnail: {
                type: String,
                default: 'https://picsum.photos/1024/400/?image=41'
            }
        },
        methods: {
            onImageError(e) {
                e.target.src = "/icons/svg/music.svg";
                $(e.target).addClass('p-1');
            },
            play() {
                this.$emit('play', this.song);
            }
        },
        computed: {
            aliases() {
                return concatStrings(this.song.artistAliases.map(alias => alias.name), ';');
            },
            duration() {
                return secondsToFormattedMinutes(this.song.playtime_seconds)
            },
            coverUrl() {
                return getSongIconUrl(this.song.id)
            },
            ...mapGetters([
                'ACTIVE_SONG'
            ])
        }
    }

</script>
<style scoped>
    .thumb {
        object-fit: cover;
        width: 50px !important;
        height: 50px;
    }
</style>
