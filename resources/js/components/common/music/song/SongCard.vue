<template>
    <div class="container pb-3">
        <div class="row w-100 text-white">
            <img :src="coverUrl" class="thumb" @error="onImageError">
            <div class="ml-2 mt-2 row col">
                <div>
                    <h6 class="mb-0">{{song.title}}</h6>
                    <span class="text-muted">{{aliases}} </span>
                </div>
                <div class="ml-auto row">
                    <span class="pr-4 text-muted">{{song.bitrate / 1000}} кбит/с</span>
                    <span>{{duration}}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {concatStrings, secondsToFormattedMinutes} from '../../../../util/stringHelper'
    import {getAlbumCoverUrl, getSongIconUrl} from "../../../../api/mediaApi";

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
            }
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
