<template>
    <div class="player bg-dark container-fluid">
        <div class="row h-100 position-relative">
            <div class="col-2 col-md-1 player-control">
                <button id="mp-play-btn" class="btn btn-dark" v-if="!playing" @click="play">
                    <img class="icon-btn-md" src="/icons/svg/player/play.svg">
                </button>
                <button id="mp-pause-btn" class="btn btn-dark" v-else @click="pause">
                    <img class="icon-btn-md" src="/icons/svg/player/pause.svg">
                </button>
            </div>

            <div class="progress-bar-wrapper">
                <div class="player-progress" @mousedown="seekPosition" title="Time played : Total time">
                    <div class="player-seeker" :style="{ width: this.percentCompleted + '%' }"></div>
                </div>
            </div>

            <audio controls id="main-player"
                   src="https://rep.tj/upload/iblock/449/449038a9c2a06b4f9b818b274f6bec8e.mp3"></audio>

        </div>
    </div>
</template>

<script>
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
                timeDrag: false
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
            }
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
