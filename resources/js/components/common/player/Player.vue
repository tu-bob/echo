<template>
    <div class="player bg-dark container-fluid">
        <div class="row h-100 position-relative">
            <div class="d-none d-sm-flex col-sm-2 col-md-4 player-control">
                <div class="col-12 col-md-3 col-lg-2">
                    <b-img class="thumb-sm" rounded src="https://pbs.twimg.com/media/C6zsy6EW0AA_VVt.jpg:large"
                           alt=""></b-img>
                </div>
                <div class="d-none d-md-block col-md-9 col-lg-10">
                    <h6 class="mb-0">Ман ери туям</h6>
                    <span class="text-muted">Далер Назаров</span>
                </div>
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
                        <div id="mp-play-btn" class="btn btn-dark" v-if="!playing" @click="play">
                            <font-awesome-icon icon="play" size="lg"></font-awesome-icon>
                        </div>
                        <div id="mp-pause-btn" class="btn btn-dark" v-else @click="pause">
                            <font-awesome-icon icon="pause" size="lg"></font-awesome-icon>
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
                   src="https://rep.tj/upload/iblock/449/449038a9c2a06b4f9b818b274f6bec8e.mp3"></audio>

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
    import {getSongIconUrl} from "../../../api/mediaApi";
    import {concatStrings} from "../../../util/stringHelper";

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
                timeDrag: false,
                song: null
            }
        },
        methods: {
            onMetaLoaded(e) {
                if (this.audio.readyState >= 2) {
                    this.durationSeconds = this.audio.duration
                }
            },
            onTimeUpdated(e) {
                this.currentSeconds = this.audio.currentTime;
            },
            play() {
                this.playing = true;
                this.audio.play();
            },
            pause() {
                this.playing = false;
                this.audio.pause();
            },
            seekPosition(e) {
                this.timeDrage = true;
                let position = e.pageX - $(this.progressBar).offset().left;
                let percentage = 100 * position / $(this.progressBar).width();
                this.audio.currentTime = percentage * this.durationSeconds / 100;
                console.log(this.audio.currentTime)
            }
        },
        computed: {
            percentCompleted() {
                if (this.durationSeconds > 0) {
                    return this.currentSeconds / this.durationSeconds * 100;
                } else return 0;
            },
            coverUrl() {
                if (this.song)
                    return getSongIconUrl(this.song.id)
            },
            aliases() {
                return concatStrings(this.song.artistAliases.map(alias => alias.name), ';');
            },
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
