<template>
    <div class="container-fluid mb-3 h-border-violet" :class="{active: ACTIVE_SONG && ACTIVE_SONG.id === song.id}">
        <div class="form-row w-100 text-white text-left" @click="play">
            <img :src="coverUrl" class="thumb" @error="onImageError">
            <div class="ml-0 ml-md-2 mt-2 row col position-relative">
                <div>
                    <h6 class="mb-0 text-no-wrap">{{song.title}}</h6>
                    <span class="text-muted">{{aliases}} </span>
                </div>
                <div class="ml-auto d-flex flex-nowrap align-items-baseline h-100" style="position: absolute; right:0;background:black">
                    <a class="btn btn-link" :href="`/media/music/song/${song.id}/download`" download>
                        <font-awesome-icon class="text-secondary h-text-white" icon="download" size="lg"></font-awesome-icon>
                    </a>
                    <span class="d-none d-sm-block">{{duration}}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {concatStrings, secondsToFormattedMinutes} from '../../../../util/stringHelper'
    import {getSongIconUrl} from "../../../../api/mediaApi";
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
