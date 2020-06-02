<template>
    <div>
        <div class="player bg-dark container-fluid text-white" variant="dark">
            <div class="row h-100 position-relative">
                <div class="d-none d-sm-flex col-sm-2 col-md-4 player-control">
                    <template v-if="ACTIVE_SONG">
                        <div class="col-12 col-md-3 col-xl-2">
                            <safe-image :src="coverUrl" fallbackSrc="/icons/svg/music.svg" class="thumb-sm"
                                        rounded></safe-image>
                        </div>
                        <div class="d-none d-md-block col-md-9 col-xl-10">
                            <h6 class="mb-0 text-white text-no-wrap">{{ACTIVE_SONG.title}}</h6>
                            <span class="text-muted text-no-wrap">{{aliases}}</span>
                        </div>
                    </template>
                </div>
                <div class="col-9 col-sm-7 col-md-4">
                    <div class="form-row player-control">
                        <div class="mx-auto">
                            <div id="mp-shuffle-btn" @click="toggleShuffle" class="btn btn-dark text-muted">
                                <font-awesome-icon :class="{'text-white': shuffled}" icon="random"
                                                   :size="playerBtnSize"></font-awesome-icon>
                            </div>
                            <div id="mp-prev-btn" class="btn btn-dark" @click="prev">
                                <font-awesome-icon icon="backward" :size="playerBtnSize"></font-awesome-icon>
                            </div>
                            <div id="mp-play-pause-btn" class="btn btn-dark" @click="togglePlayPause">
                                <font-awesome-icon icon="play" :size="playerBtnSize"
                                                   v-if="!playing"></font-awesome-icon>
                                <font-awesome-icon icon="pause" :size="playerBtnSize" v-else></font-awesome-icon>
                            </div>
                            <div id="mp-next-btn" class="btn btn-dark" @click="next">
                                <font-awesome-icon icon="forward" :size="playerBtnSize"></font-awesome-icon>
                            </div>
                            <div id="mp-repeat-btn" @click="toggleRepeat"
                                 class="btn btn-dark position-relative"
                                 :class="{'text-white': REPEAT_STATE !== 'none', 'text-muted': REPEAT_STATE === 'none'}">
                                <font-awesome-icon icon="redo-alt" :size="playerBtnSize"></font-awesome-icon>
                                <span v-show="REPEAT_STATE === 'single'" class="position-absolute"
                                      style="bottom:0; right:6px">1</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ml-sm-auto form-row player-control">
                    <b-form-input class="align-self-center mr-3 d-none d-lg-block"
                                  style="width:80px"
                                  type="range"
                                  v-model="volume"
                                  variant="dark"
                                  step="0.01"
                                  min="0"
                                  max="1"></b-form-input>
                    <div class="d-none d-md-block pr-3">
                        {{currentTimeFormatted}}
                    </div>
                    <div id="mp-download-btn" class="d-none d-md-block" v-if="ACTIVE_SONG">
                        <a :href="`/media/music/song/${ACTIVE_SONG.id}/download`"
                           download
                           class="btn btn-dark"
                           :class="{'disabled': !ACTIVE_SONG.allow_download}">
                            <font-awesome-icon icon="download" :size="playerBtnSize"></font-awesome-icon>
                        </a>
                    </div>
                    <div id="mp-lyrics-btn" title="Откройте текст песни и не стесняйтесь подпевать"
                         class="btn btn-dark d-none d-md-block"
                         @click="openPlayerOverlay('lyrics')">
                        <font-awesome-icon icon="align-left" :size="playerBtnSize"></font-awesome-icon>
                    </div>
                    <b-dropdown @click.stop class="d-md-none" toggle-class="transparent-btn" right no-caret>
                        <template v-slot:button-content>
                            <font-awesome-icon icon="ellipsis-h"></font-awesome-icon>
                        </template>
                        <b-dropdown-item @click.stop>
                            <div v-if="ACTIVE_SONG">
                                <a :href="`/media/music/song/${ACTIVE_SONG.id}/download`"
                                   download
                                   class="transparent-btn text-decoration-none text-dark"
                                   :class="{'disabled': !ACTIVE_SONG.allow_download}">
                                    <font-awesome-icon icon="download" class="mr-3"></font-awesome-icon>
                                    Скачать песню
                                </a>
                            </div>
                        </b-dropdown-item>
                        <b-dropdown-item @click.stop @click="openPlayerOverlay('lyrics')">
                            <font-awesome-icon icon="align-left" class="mr-3"></font-awesome-icon>
                            Открыть текст песни
                        </b-dropdown-item>
                        <b-dropdown-item v-if="ACTIVE_SONG" @click.stop
                                         :to="{name:'artist-view', params:{id:ACTIVE_SONG.artistAliases[0].id}}">
                            <font-awesome-icon icon="user" class="mr-3"></font-awesome-icon>
                            Перейти к исполнителю
                        </b-dropdown-item>
                    </b-dropdown>
                    <div id="mp-playlist-btn" title="Откройте плейлист и найдите песню для души"
                         class="btn btn-dark mr-0 mr-sm-4 mr-md-3"
                         @click="openPlayerOverlay('playlist')">
                        <font-awesome-icon icon="list" :size="playerBtnSize"></font-awesome-icon>
                    </div>
                </div>
                <div class="progress-bar-wrapper">
                    <div class="player-progress" @mousedown="seekPosition">
                        <div class="player-loading-progress" :style="{ width: this.loadedPercentage + '%' }"></div>
                        <div class="player-seeker" :style="{ width: this.playedPercentage + '%' }"></div>
                    </div>
                </div>
                <div class="player-disable-overlay" v-show="!ACTIVE_SONG"></div>
            </div>

            <y-audio-player id="main-player"
                            ref="main-player"
                            class="d-none"
                            preload="auto"
                            :src="audioSrc"
                            :nextSrc="nextAudioSrc"
                            @pause="playing = false"
                            @abort="playing = false"
                            @error="onError"
                            @play="onPlayBegin"
                            @ended="onEnded"
                            @canplay="onCanPlay"
                            @timeupdate="onTimeUpdated"
                            @playedpercentage="onPlayedPercentageUpdate"
                            @loadedpercentage="onLoadedPercentageUpdate"
                            :loop="REPEAT_STATE === 'single'">
            </y-audio-player>

            <b-overlay :show="isFetchingSong" variant="dark" no-wrap>
                <template v-slot:overlay>
                    <div class="d-flex align-items-center">
                        <b-spinner class="ml-auto"></b-spinner>
                        <span>&nbsp;Загружаем...</span>
                    </div>
                </template>
            </b-overlay>
        </div>
        <div class="player-overlay" v-show="showPlayerOverlay">
            <div class="position-sticky d-flex" style="top:0; left:0">
                <div class="ml-auto btn" @click="togglePlayerOverlay">
                    <font-awesome-icon icon="times" class="text-white" size="2x"></font-awesome-icon>
                </div>
            </div>
            <b-container class="player-overlay-content" fluid="md">
                <songs-list v-if="overlayContent === 'playlist'" class="w-100" :playlist="PLAYLIST"></songs-list>
                <div v-if="overlayContent === 'lyrics'" class="text-white">
                    <pre
                        v-if="ACTIVE_SONG.lyrics" class="song-lyrics">{{ACTIVE_SONG.lyrics}}</pre>
                    <div v-else>
                        Текст песни еще не добавлен
                    </div>
                </div>
            </b-container>
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
        faList,
        faTimes,
        faDownload,
        faAlignLeft,
        faEllipsisH,
        faUser
    } from '@fortawesome/free-solid-svg-icons'
    import {getAudioFileUrl, getSongIconUrl} from "../../../api/mediaApi";
    import {concatStrings, secondsToFormattedMinutes} from "../../../util/stringHelper";
    import {mapGetters} from "vuex";
    import SongsList from "../music/song/SongsList";
    import SafeImage from "../image/SafeImage";
    import ViewportSize from "../mixins/ViewportSize";
    import YAudioPlayer from "./YAudioPlayer";

    library.add(faPlay,
        faPause,
        faBackward,
        faForward,
        faRandom,
        faRedoAlt,
        faList,
        faTimes,
        faDownload,
        faAlignLeft,
        faEllipsisH,
        faUser);

    export default {
        name: "Player",
        components: {YAudioPlayer, SafeImage, SongsList},
        mixins: [ViewportSize],
        mounted() {
            // this.$refs['main-player'] = this.$refs['main-player'];
            this.progressBar = this.$el.querySelectorAll('.player-progress')[0];
            this.initChromeMediaControls()
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
                bufferedSeconds: 0,
                playing: false,
                timeDrag: false,
                showPlayerOverlay: false,
                overlayContent: 'playlist',
                shuffled: false,
                playCountUpdated: false,
                volume: 1,
                isFetchingSong: false,
                playedPercentage: 0,
                loadedPercentage: 0,
                nextAudioSrc: null
            }
        },
        methods: {
            onProgress(e) {
                if (e.target.buffered.length > 0)
                    this.bufferedSeconds = e.target.buffered.end(e.target.buffered.length - 1)
            },
            // onMetaLoaded(e) {console.log(e)
            //     if (this.$refs['main-player'].readyState >= 2) {
            //         this.durationSeconds = this.$refs['main-player'].duration;
            //         this.playing = true;
            //     }
            // },
            onTimeUpdated(currentTime) {
                this.currentSeconds = currentTime;
            },
            onPlayedPercentageUpdate(percentage) {
                this.playedPercentage = percentage;
            },
            onLoadedPercentageUpdate(percentage) {
                this.loadedPercentage = percentage;
            },
            onPlayBegin() {
                this.durationSeconds = this.$refs['main-player'].getDuration;
                this.playing = true;
            },
            onEnded() {
                this.playing = false;
                switch (this.REPEAT_STATE) {
                    case "none":
                        this.$store.commit('PLAY_NEXT', false);
                        break;
                    case "all":
                        this.$store.commit('PLAY_NEXT');
                        break;
                }
            },
            onCanPlay() {
                this.isFetchingSong = false;
                this.updateChromeMeta()
            },
            onError(e) {
                console.log(e);
                this.playing = false;
                this.isFetchingSong = false;
                this.onEnded();
            },
            updateChromeMeta() {
                if ('mediaSession' in navigator) {
                    navigator.mediaSession.metadata = new MediaMetadata({
                        title: this.ACTIVE_SONG.title,
                        artist: concatStrings(this.ACTIVE_SONG.artistAliases.map(alias => alias.name), ' ·'),
                        album: this.ACTIVE_SONG.albumsTitles ? this.ACTIVE_SONG.albumsTitles : '',
                        artwork: [
                            {
                                src: getSongIconUrl(this.ACTIVE_SONG.id, {width: 512, height: 512}),
                                sizes: '512x512',
                                type: 'image/png'
                            },
                        ]
                    })
                }
            },
            initChromeMediaControls() {
                if ('mediaSession' in navigator) {
                    var vm = this;
                    navigator.mediaSession.setActionHandler('previoustrack', function () {
                        vm.next();
                    });

                    navigator.mediaSession.setActionHandler('nexttrack', function () {
                        vm.prev()
                    });

                    if ('setPositionState' in navigator.mediaSession) {
                        navigator.mediaSession.setPositionState({
                            duration: this.$refs['main-player'].getDuration(),
                            playbackRate: 1,
                            position: this.currentSeconds
                        })
                        ;
                    }
                }

            },
            togglePlayPause() {
                this.playing = !this.playing;
            },
            seekPosition(e) {
                this.timeDrage = true;
                let position = e.pageX - $(this.progressBar).offset().left;
                let percentage = 100 * position / $(this.progressBar).width();
                this.$refs['main-player'].setCurrentTime(percentage * this.$refs['main-player'].getDuration() / 100);
            },
            // onImageError(e) {
            //     e.target.src = "/icons/svg/music.svg";
            //     $(e.target).addClass('p-1');
            // },
            togglePlayerOverlay(content) {
                this.overlayContent = content;
                this.showPlayerOverlay = !this.showPlayerOverlay
            },
            openPlayerOverlay(content) {
                this.overlayContent = content;
                this.showPlayerOverlay = true;
            },
            toggleShuffle() {
                if (!this.shuffled)
                    this.$store.commit('SHUFFLE');
                else
                    this.$store.commit('RESTORE_ORDER');
                this.shuffled = !this.shuffled;
            },
            toggleRepeat() {
                let state = [
                    'none',
                    'all',
                    'single'
                ];

                let index = state.indexOf(this.REPEAT_STATE) + 1;
                let newState = state[0];
                if (index < state.length)
                    newState = state[index];

                this.$store.commit('SET_REPEAT_STATE', newState);
            },
            next() {
                this.$store.commit('PLAY_NEXT');
            },
            prev() {
                this.$store.commit('PLAY_PREV');
            },
            updateDocumentMeta() {
                document.title = this.ACTIVE_SONG.title + ' - '
                    + concatStrings(this.ACTIVE_SONG.artistAliases.map(alias => alias.name), ';');
                $("link[rel*='icon']").attr("href", getSongIconUrl(this.ACTIVE_SONG.id, {width: 200, height: 200}));
            }
        },
        watch: {
            playing() {
                if (this.playing) {
                    this.$refs['main-player'].play();
                    if (!this.playCountUpdated) {
                        axios.put(`/media/music/song/${this.ACTIVE_SONG.id}/play`);
                        this.playCountUpdated = true
                    }
                } else this.$refs['main-player'].pause();
            },
            volume() {
                this.$refs['main-player'].setVolume(this.volume);
            },
            ACTIVE_SONG() {
                this.isFetchingSong = true;
                this.bufferedSeconds = 0;
                this.playCountUpdated = false;
            },
            showPlayerOverlay() {
                return this.showPlayerOverlay ? $('body').addClass('overflow-hidden') : $('body').removeClass('overflow-hidden');
            }
        },
        computed: {
            // percentCompleted() {
            //     return this.durationSeconds > 0 ? this.currentSeconds / this.durationSeconds * 100 : 0;
            // },
            // percentLoaded() {
            //     return this.durationSeconds > 0 ? this.bufferedSeconds / this.durationSeconds * 100 : 0;
            // },
            coverUrl() {
                if (this.ACTIVE_SONG)
                    return getSongIconUrl(this.ACTIVE_SONG.id)
            },
            aliases() {
                return concatStrings(this.ACTIVE_SONG.artistAliases.map(alias => alias.name), ';');
            },
            audioSrc() {
                if (this.ACTIVE_SONG) {
                    this.playing = true;
                    this.nextAudioSrc = getAudioFileUrl(this.NEXT_SONG.id);
                    // console.log(this.NEXT_SONG)
                    this.updateDocumentMeta();
                    return getAudioFileUrl(this.ACTIVE_SONG.id);
                }
            },
            currentTimeFormatted() {
                if (this.currentSeconds)
                    return secondsToFormattedMinutes(Math.round(this.currentSeconds));
                else
                    return '0:00'
            },
            playerBtnSize() {
                return this.windowWidth < 900 ? '1x' : 'lg'
            },
            ...mapGetters([
                'PLAYLIST',
                'ACTIVE_SONG',
                'REPEAT_STATE',
                'NEXT_SONG'
            ])
        }
    }
</script>

<style scoped>
    .player {
        z-index: 1000;
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
        background-color: gray;
        cursor: pointer;
        height: 100%;
        min-width: 200px;
        position: relative;
    }

    .player-progress .player-seeker {
        background: linear-gradient(39deg, #15c0e9 0%, #f0536a 80%);
        bottom: 0;
        left: 0;
        position: absolute;
        top: 0;
    }

    .player-progress .player-loading-progress {
        background: #ffffff;
        bottom: 0;
        left: 0;
        top: 0;
        position: absolute;
    }

    .player-overlay {
        z-index: 200;
        overflow: scroll;
        width: 100%;
        position: fixed;
        bottom: 66px;
        top: 0;
        left: 0;
        backdrop-filter: blur(6px);
        opacity: 0.95;
        background: linear-gradient(135deg, #373737 0%, #24181e 95%);
    }

    .player-overlay::-webkit-scrollbar {
        display: none;
    }

    .player-disable-overlay {
        top: -6px;
        left: 0;
        right: 0;
        position: absolute;
        height: 66px;
        background: #000000;
        filter: blur(2px);
        opacity: 0.5;
    }

    .player-overlay-content {
        position: fixed;
        top: 50px;
        left: 0;
        right: 0;
        bottom: 0;
        overflow: scroll
    }

    .player-overlay-content::-webkit-scrollbar {
        display: none;
    }

    .song-lyrics {
        color: #ffffff;
        font-size: 18px;
        text-align: center;
    }
</style>
