<template>
    <div class="d-none"></div>
</template>

<script>
    export default {
        name: "YAudioPlayer",
        created() {
            try {
                this.initPlayer()
            } catch (e) {
                console.log(e)
            }
        },
        data() {
            return {
                yaPlayer: null,
                resume: false,
                lastSrc: null
            }
        },
        props: {
            preferredPlayerType: 'html5',
            flashOverlayElement: 'null',
            src: null,
            loop: false,
            nextSrc: null
        },
        methods: {
            initPlayer() {
                let handleState = function (vm) {
                    return function (state) {
                        switch (state) {
                            case ya.music.Audio.STATE_INIT:
                                console.log("Инициализация плеера");
                                break;
                            case ya.music.Audio.STATE_IDLE:
                                console.log("Плеер готов и ожидает");
                                break;
                            case ya.music.Audio.STATE_PLAYING:
                                console.log("Плеер проигрывает музыку");
                                break;
                            case ya.music.Audio.STATE_PAUSED:
                                console.log("Плеер поставлен на паузу");
                                break;
                            case ya.music.Audio.STATE_CRASHED:
                                console.log("Не удалось инициализировать плеер");
                                break;
                        }
                    }
                };

                this.yaPlayer = new ya.music.Audio(this.preferredPlayerType, this.flashOverlayElement);
                this.yaPlayer.on(ya.music.Audio.EVENT_STATE, handleState(this));

                let emitEvent = function (event, vm) {
                    return function (payload) {
                        vm.$emit(event, payload);
                    };
                };

                let handleProgress = function (vm) {
                    return function (payload) {
                        vm.onProgress(payload);
                    };
                };

                let handleLoaded = function (vm) {
                    console.log('loaded');
                    return function (payload) {
                        vm.onLoaded(payload);
                    }
                };

                // let handleEnded = function (vm) {
                //     return function (payload) {
                //         vm.onEnded(payload);
                //     };
                // };

                this.yaPlayer.on(ya.music.Audio.EVENT_PLAY, emitEvent("play", this));
                this.yaPlayer.on(ya.music.Audio.EVENT_PLAY, emitEvent("canplay", this));
                this.yaPlayer.on(ya.music.Audio.EVENT_STOP, emitEvent("stop", this));
                this.yaPlayer.on(ya.music.Audio.EVENT_PAUSE, emitEvent("pause", this));

                this.yaPlayer.on(ya.music.Audio.EVENT_PROGRESS, handleProgress(this));
                this.yaPlayer.on(ya.music.Audio.EVENT_ENDED, emitEvent("ended", this));
                // this.yaPlayer.on(ya.music.Audio.EVENT_ENDED, handleEnded(this));

                this.yaPlayer.on(ya.music.Audio.EVENT_LOADING, emitEvent("loading", this));
                this.yaPlayer.on(ya.music.Audio.EVENT_LOADED, emitEvent("loaded", this));
                this.yaPlayer.on(ya.music.Audio.EVENT_LOADED, handleLoaded(this));

                this.yaPlayer.on(ya.music.Audio.EVENT_VOLUME, emitEvent("volume", this));

                this.yaPlayer.on(ya.music.Audio.EVENT_ERROR, emitEvent("error", this));
                this.yaPlayer.on(ya.music.Audio.EVENT_CRASHED, emitEvent("abort", this));

                this.yaPlayer.on(ya.music.Audio.EVENT_SWAP, emitEvent("swap", this));
            },
            play() {
                if (this.resume || this.src === this.lastSrc)
                    this.yaPlayer.resume();
                else {
                    this.playTrack();
                }
            },
            playTrack() {
                this.lastSrc = this.src;
                if (this.yaPlayer.isPreloaded(this.src)) {
                    console.log(this.src, 'preloaded')
                    this.yaPlayer.playPreloaded(this.src);
                } else {
                    console.log(this.src, 'not preloaded')
                    this.yaPlayer.play(this.src);
                }
                this.resume = true;
            },
            pause() {
                this.yaPlayer.pause();
            },
            stop() {
                this.yaPlayer.stop();
            },
            getDuration() {
                return this.yaPlayer.getDuration()
            },
            onProgress(e) {
                if (this.loop && this.getDuration() - e.position < 1)
                    this.setCurrentTime(0);
                this.timeUpdate(e.position);
                this.playedPercentage(e.position);
                this.loadedPercentage(e.loaded);
            },
            onLoaded(e) {
                if (this.nextSrc && this.nextSrc !== this.yaPlayer.getSrc(1)) {
                    this.yaPlayer.preload(this.nextSrc)
                }
            },
            timeUpdate(time) {
                this.$emit('timeupdate', time);
            },
            playedPercentage(time) {
                this.$emit('playedpercentage', this.getDuration() > 0 ? time / this.getDuration() * 100 : 0);
            },
            loadedPercentage(buffered) {
                this.$emit('loadedpercentage', this.getDuration() > 0 ? buffered / this.getDuration() * 100 : 0);
            },
            setCurrentTime(time) {
                this.yaPlayer.setPosition(time)
            },
            setVolume(volume) {
                this.yaPlayer.setVolume(volume);
            },
            // onEnded() {
            //     if (this.loop) {
            //         console.log('ended')
            //         this.yaPlayer.restart().catch(e => console.log(e)).then(r => console.log(r, 'resumed'));
            //     }
            // }
        },
        watch: {
            src() {
                // this.stop();
                this.resume = false;
                this.play();
            }
        }
    }
</script>
