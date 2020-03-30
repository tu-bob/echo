<template>
    <div class="player bg-dark container-fluid">
        <div class="row h-100 position-relative">
            <div class="d-none d-sm-flex col-sm-2 col-md-4 player-control">
                <template v-if="ACTIVE_SONG">
                    <div class="col-12 col-md-3 col-xl-2">
                        <b-img class="thumb-sm" rounded :src="coverUrl" @error="onImageError"
                               alt=""></b-img>
                    </div>
                    <div class="d-none d-md-block col-md-9 col-xl-10">
                        <h6 class="mb-0 text-white">{{ACTIVE_SONG.title}}</h6>
                        <span class="text-muted">{{aliases}}</span>
                    </div>
                </template>
            </div>
            <div class="col-9 col-sm-8 col-md-4">
                <div class="row player-control">
                    <div class="mx-auto">
                        <div id="mp-shuffle-btn" class="btn btn-dark text-muted">
                            <font-awesome-icon icon="random" size="lg"></font-awesome-icon>
                        </div>
                        <div id="mp-prev-btn" class="btn btn-dark">
                            <font-awesome-icon icon="backward" size="lg"></font-awesome-icon>
                        </div>
                        <div id="mp-play-pause-btn" class="btn btn-dark" @click="togglePlayPause">
                            <font-awesome-icon icon="play" size="lg" v-if="!playing"></font-awesome-icon>
                            <font-awesome-icon icon="pause" size="lg" v-else></font-awesome-icon>
                        </div>
                        <div id="mp-next-btn" class="btn btn-dark">
                            <font-awesome-icon icon="forward" size="lg"></font-awesome-icon>
                        </div>
                        <div id="mp-repeat-btn" class="btn btn-dark text-muted">
                            <font-awesome-icon icon="redo-alt" size="lg"></font-awesome-icon>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2 col-md-4">
                <div class="row player-control">
                    <div class="d-none d-md-block col-md-8">
                        00:000:000:0000
                    </div>
                    <div class="col-12 col-md-4">
                        <div id="mp-playlist-btn" class="btn btn-dark">
                            <font-awesome-icon icon="list" size="lg"></font-awesome-icon>
                        </div>
                    </div>
                </div>
            </div>


            <div class="progress-bar-wrapper">
                <div class="player-progress" @mousedown="seekPosition" title="Time played : Total time">
                    <div class="player-seeker" :style="{ width: this.percentCompleted + '%' }"></div>
                </div>
            </div>

            <audio controls class="d-none" id="main-player"
                   :src="audioSrc"></audio>

        </div>
    </div>
</template>

<script>
    import {library} from '@fortawesome/fontawesome-svg-core'
    import {
        faPlay,
        faPause,
        faBackward,
        faForward,
        faRandom,
        faRedoAlt,
        faList
    } from '@fortawesome/free-solid-svg-icons'
    import {fetchAudioFile, getSongIconUrl} from "../../../api/mediaApi";
    import {concatStrings} from "../../../util/stringHelper";
    import {mapGetters} from "vuex";

    library.add(faPlay, faPause, faBackward, faForward, faRandom, faRedoAlt, faList);

    export default {
        name: "Player",
        mounted() {
            this.audio = this.$el.querySelectorAll('audio')[0];
            this.progressBar = this.$el.querySelectorAll('.player-progress')[0];
            this.audio.addEventListener('loadeddata', this.onMetaLoaded);
            this.audio.addEventListener('timeupdate', this.onTimeUpdated);
            this.audio.addEventListener('pause', () => {
                this.playing = false;
            });
            this.audio.addEventListener('play', () => {
                this.playing = true;
            });
            this.audio.addEventListener('abort', () => {
                this.playing = false;
            });
            this.audio.addEventListener('error', () => {
                this.playing = false;
            });
        },
        props: {
            autoPlay: {
                type: Boolean,
                default: false
            }
        },
        data() {
            return {
                audio: null,
                progressBar: null,
                currentSeconds: 0,
                durationSeconds: 0,
                playing: false,
                timeDrag: false
            }
        },
        methods: {
            onMetaLoaded(e) {
                if (this.audio.readyState >= 2) {
                    this.durationSeconds = this.audio.duration
                    this.playing = true;
                }
            },
            onTimeUpdated(e) {
                this.currentSeconds = this.audio.currentTime;
            },
            togglePlayPause() {
                this.playing = !this.playing;
            },
            seekPosition(e) {
                this.timeDrage = true;
                let position = e.pageX - $(this.progressBar).offset().left;
                let percentage = 100 * position / $(this.progressBar).width();
                this.audio.currentTime = percentage * this.durationSeconds / 100;
                console.log(this.audio.currentTime)
            },
            onImageError(e) {
                e.target.src = "/icons/svg/music.svg";
                $(e.target).addClass('p-1');
            }
        },
        watch: {
            playing() {
                if (this.playing)
                    this.audio.play();
                else this.audio.pause();
            }
        },
        computed: {
            percentCompleted() {
                if (this.durationSeconds > 0) {
                    return this.currentSeconds / this.durationSeconds * 100;
                } else return 0;
            },
            coverUrl() {
                if (this.ACTIVE_SONG)
                    return getSongIconUrl(this.ACTIVE_SONG.id)
            },
            aliases() {
                return concatStrings(this.ACTIVE_SONG.artistAliases.map(alias => alias.name), ';');
            },
            audioSrc() {
                if (this.ACTIVE_SONG) {
                    this.playing = false;
                    return fetchAudioFile(this.ACTIVE_SONG.id);
                }
            },
            ...mapGetters([
                'PLAYLIST',
                'ACTIVE_SONG'
            ])
        }
    }
</script>

<style scoped>
    .player {
        position: fixed;
        bottom: 0;
        left: 0;
        height: 60px;
        width: 100%;
    }

    .player-control {
        display: flex;
        align-items: center !important;
        height: 100%
    }

    .progress-bar-wrapper {
        margin: 0 !important;
        position: absolute;
        top: -6px;
        left: 0;
        height: 6px;
        width: 100% !important;
    }

    .player-progress {
        background-color: #ffef30;
        cursor: pointer;
        height: 100%;
        min-width: 200px;
        position: relative;
    }

    .player-progress .player-seeker {
        background-color: #ff3f2b;
        bottom: 0;
        left: 0;
        position: absolute;
        top: 0;
    }
</style>
