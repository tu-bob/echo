<template>
    <b-container fluid="md" v-if="song">
        <b-row>
            <b-col md="4" lg="3">
                <div class="w-100 pt-5">
                    <safe-image
                        class="w-100 mx-auto"
                        style="max-width: 350px"
                        :src="coverUrl">
                    </safe-image>
                    <!--                    <h3 class="mt-3 typography-footnote-emphasized text-uppercase text-secondary">-->
                    <!--                        {{song.type.name}}</h3>-->
                </div>
            </b-col>
            <b-col md="8" lg="9" class="pl-md-5 pt-5">
                <h1 class="typography-title-emphasized text-white">{{song.title}}</h1>
                <h2>
                    <router-link class="typography-title text-violet text-decoration-none"
                                 :to="{name:'artist-view', params:{id:alias.id}}"
                                 v-for="(alias,index) in song.artistAliases" :key="alias.id">
                        {{alias.name}}

                        <span v-if="index < song.artistAliases.length - 1"> · </span>
                    </router-link>
                </h2>
                <h3 class="typography-footnote-emphasized text-uppercase text-secondary">
                    {{genres}} <span v-if="song.year">· {{song.year}}</span></h3>
                <h3 class="typography-footnote-emphasized text-uppercase text-secondary" v-if="song.label">
                    Лейбл {{song.label}}
                </h3>
                <div class="d-flex mt-3">
                    <b-button variant="outline-secondary" pill @click="playSongs([song])" class="mr-3">
                        <font-awesome-icon icon="play" size="sm" class="mr-1"></font-awesome-icon>
                        Слушать
                    </b-button>
                    <network-share
                        :url="pageUrl"
                        :title="title"
                        :description="description"
                        quote="Echo.tj - Музыкальное наследие Таджикистана"
                        :media="fullCoverUrl"
                        :hash-tags="hashTags">
                    </network-share>
                </div>

                <template v-if="song.lyrics">
                <pre class="song-lyrics" style="max-height: 100px">{{song.lyrics}}
                </pre>
                    <a href="#" @click="showLyrics = !showLyrics">
                        <span v-if="!showLyrics">Показать текст</span>
                        <span v-else>Скрыть текст</span>
                    </a>
                </template>
            </b-col>
        </b-row>

        <div class="mt-5" v-if="song.albums && song.albums.length > 0">
            <h3 class="typography-title text-white mb-4">Песня в альбомах</h3>
            <div class="d-flex flex-wrap justify-content-start">
                <album-card class="mb-4 mr-4" style="width: 350px" v-for="album in song.albums" :key="album.id"
                            :album="album"></album-card>
            </div>
        </div>

        <div class="d-flex w-100 flex-wrap justify-content-center align-items-baseline mt-5">
            <a v-if="getLink('googleMusic')" target="blank" :href="getLink('googleMusic')">
                <img width="220px" class="mr-3 mb-3" src="/icons/png/google-play-logo.png">
            </a>
            <a v-if="getLink('yandexMusic')" target="blank" :href="getLink('yandexMusic')">
                <img width="260px" class="mr-3 mb-3 link-border" src="/icons/svg/yandex-music-logo.svg">
            </a>
            <a v-if="getLink('appleMusic')" target="blank" :href="getLink('appleMusic')">
                <img width="280px" class="mr-3 mb-3" src="/icons/svg/apple-music-logo.svg">
            </a>
            <a v-if="getLink('spotify')" target="blank" :href="getLink('spotify')">
                <img width="220px" class="mr-3 mb-3" src="/icons/png/spotify-logo.png">
            </a>
        </div>
        <h3 v-if="song.clip" class="typography-title text-secondary mt-5">Клип</h3>
        <div v-if="song.clip" class="mt-3">
            <b-embed
                type="iframe"
                aspect="16by9"
                :src="song.clip.src"
                allowfullscreen
            ></b-embed>
        </div>
    </b-container>
</template>

<script>
    import SafeImage from "../../common/image/SafeImage";
    import {fetchSong, getSongIconUrl} from "../../../api/mediaApi";
    import {store} from "../../../store";
    import {concatStrings, getBaseUri} from "../../../util/stringHelper";
    import AlbumsList from "../../common/music/album/AlbumsList";
    import AlbumCard from "../../common/music/album/AlbumCard";
    import PlaySongsMixin from "../../admin/mixins/PlaySongsMixin";
    import {library} from '@fortawesome/fontawesome-svg-core'
    import {faPlay} from '@fortawesome/free-solid-svg-icons'
    import MetaTagsMixin from "../../admin/mixins/MetaTagsMixin";
    import NetworkShare from "../../common/inputs/NetworkShare";

    library.add(faPlay);

    export default {
        name: "SongView",
        mounted() {
            this.fetchSong();
        },
        components: {NetworkShare, AlbumCard, AlbumsList, SafeImage},
        mixins: [PlaySongsMixin, MetaTagsMixin],
        props: {
            id: null
        },
        data() {
            return {
                song: null,
                showLyrics: false,
                title: 'Echo.tj - Слушайте и скачивайте песни таджикских исполнителей',
                description: 'Страница песни содержит тексты, аккорды, видео и альбомы в которых находится композиция'
            }
        },
        methods: {
            fetchSong() {
                store.commit('SHOW_MAIN_OVERLAY');
                fetchSong(this.id)
                    .then(song => this.song = song)
                    .finally(
                        _ => {
                            store.commit('HIDE_MAIN_OVERLAY');
                        }
                    )
            },
            getLink(resource) {
                return this.song.externalLinks.find(a => a.resource === resource)?.link;
            }
        },
        computed: {
            coverUrl() {
                return getSongIconUrl(this.song.id, {width: 400, height: 400});
            },
            fullCoverUrl() {
                return getBaseUri() + '/' + this.coverUrl;
            },
            genres() {
                return concatStrings(this.song.genres.map(alias => alias.local_name), ' ·');
            },
            hashTags() {
                let tags = concatStrings(this.song.artistAliases.map(alias => alias.name), ',') +
                    ',' + this.song.title;
                if (this.song.english_title)
                    tags += ',' + this.song.english_title;
                return tags.replace(/\s/g, '');
            },
            pageUrl() {
                return window.location.href;
            }
        },
        watch: {
            showLyrics() {
                $('pre').css('max-height', this.showLyrics ? '' : '100px');
            },
            song() {
                let english = this.song.english_title ? ' | ' + this.song.english_title : '';
                let song = this.song.title + english + ' - ' +
                    concatStrings(this.song.artistAliases.map(alias => alias.name), ' ·');
                this.title = 'Слушать, скачать песню ' + song;
                this.description = 'Текст песни, аккорды, клип ' + song + ' на Echo.tj';
                this.updateTitle();
                this.updateDescription();
            }
        }
    }
</script>

<style scoped>
    .song-lyrics {
        color: #6c757d;
        margin-top: 1rem;
        margin-bottom: 0.25rem;
        overflow: hidden;
        font-size: 16px;
    }
</style>
