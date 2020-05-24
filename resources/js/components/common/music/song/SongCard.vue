<template>
    <div class="mb-3 px-0 h-border-violet h-cursor"
         :class="{active: ACTIVE_SONG && ACTIVE_SONG.id === song.id}">
        <div class="d-flex text-white text-left" @click="play">
            <safe-image :src="coverUrl"
                        fallbackSrc="/icons/svg/music.svg"
                        class="thumb"
                        :alt="`Обложка песни ${song.title} - ${aliases}`"></safe-image>
            <div class="song-details">
                <div class="song-title">
                    <h6 class="mb-0 text-no-wrap">{{song.title}}</h6>
                    <span class="text-muted text-no-wrap">{{aliases}}</span>
                </div>
                <div class="song-buttons">
                    <a class="btn transparent-btn pr-0"
                       @click.stop
                       :class="{'disabled': !song.allow_download}"
                       :href="`/media/music/song/${song.id}/download`" download>
                        <font-awesome-icon
                            :class="{'text-secondary': song.allow_download, 'text-dark': !song.allow_download}"
                            icon="download"
                            size="lg">
                        </font-awesome-icon>
                    </a>
                    <b-dropdown @click.stop toggle-class="transparent-btn" right no-caret>
                        <template v-slot:button-content>
                            <font-awesome-icon icon="ellipsis-h"
                                               class="text-secondary h-text-white">
                            </font-awesome-icon>
                        </template>
                        <b-dropdown-item :to="{name:'song-view', params:{id:song.id}}">
                           Подробности ...
                        </b-dropdown-item>
                    </b-dropdown>
                    <span>{{duration}}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {concatStrings, secondsToFormattedMinutes} from '../../../../util/stringHelper'
    import {getSongIconUrl} from "../../../../api/mediaApi";
    import {mapGetters} from "vuex";
    import SafeImage from "../../image/SafeImage";
    import {library} from '@fortawesome/fontawesome-svg-core'
    import {faDownload, faEllipsisH, faInfoCircle} from '@fortawesome/free-solid-svg-icons'

    library.add(faDownload, faEllipsisH, faInfoCircle);

    export default {
        name: "SongCard",
        components: {SafeImage},
        props: {
            song: {
                type: Object,
                required: true
            },
            thumbnail: {
                type: String
            }
        },
        methods: {
            play() {
                this.$emit('play', this.song);
            }
        },
        computed: {
            aliases() {
                return concatStrings(this.song.artistAliases.map(alias => alias.name), ' ·');
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
    .song-details {
        width: calc(100% - 60px);
        display: flex;
        margin-left: 0.5rem;
        margin-top: 0.5rem;
    }

    .thumb {
        object-fit: cover;
        width: 50px !important;
        height: 50px;
    }

    .song-title {
        flex: 1 1 auto;
        overflow: hidden;
    }

    .song-buttons {
        width: 114px;
        display: flex;
        align-items: baseline;
        height: 100%;
    }
</style>
