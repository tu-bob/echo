<template>
    <b-container class="mt-5" v-if="album">
        <b-row>
            <b-col md="4" lg="3">
                <div class="w-100 sticky-top" style="z-index: 0; padding-top:100px">
                    <safe-image
                        class="w-100 mx-auto"
                        style="max-width: 350px"
                        :src="coverUrl">
                    </safe-image>
                    <h3 class="mt-3 typography-footnote-emphasized text-uppercase text-secondary">
                        {{album.type.name}}
                    </h3>
                </div>
            </b-col>
            <b-col md="8" lg="9" class="pl-md-5" style="padding-top:100px">
                <h1 class="typography-title-emphasized text-white">{{album.title}}</h1>
                <h2>
                    <router-link class="typography-title text-accent text-decoration-none"
                                 :to="{name:'artist-view', params:{id:alias.id}}"
                                 v-for="(alias,index) in album.artistAliases" :key="alias.id">
                        {{alias.name}}

                        <span v-if="index < album.artistAliases.length - 1"> · </span>
                    </router-link>
                </h2>
                <h3 class="typography-footnote-emphasized text-uppercase text-secondary">
                    {{genres}} · {{album.year}}</h3>
                <div class="d-flex mt-3">
                    <b-button variant="outline-secondary" pill @click="playSongs(album.songs)" class="mr-3">
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
                <songs-list :playlist="album.songs" class="pt-4"></songs-list>
            </b-col>
        </b-row>

        <div class="d-flex w-100 flex-wrap justify-content-end align-items-baseline mt-5">
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
            <a v-if="getLink('youtube')" target="blank" :href="getLink('youtube')">
                <img width="220px" class="mr-3 mb-3" src="/icons/png/youtube-logo.png">
            </a>

        </div>
    </b-container>
</template>

<script>
    import SafeImage from "../../common/image/SafeImage";
    import {fetchAlbum, getAlbumCoverUrl} from "../../../api/mediaApi";
    import {store} from "../../../store";
    import {concatStrings, getBaseUri} from "../../../util/stringHelper";
    import SongsList from "../../common/music/song/SongsList";
    import MetaTagsMixin from "../../admin/mixins/MetaTagsMixin";
    import NetworkShare from "../../common/inputs/NetworkShare";
    import PlaySongsMixin from "../../admin/mixins/PlaySongsMixin";

    export default {
        name: "AlbumView",
        mounted() {
            this.fetchAlbum();
        },
        components: {NetworkShare, SongsList, SafeImage},
        mixins: [MetaTagsMixin, PlaySongsMixin],
        data() {
            return {
                album: null,
                title: 'Echo.tj - Слушайте и скачивайте музыкальные альбомы таджикских исполнителей',
                description: 'Слушайте и скачивайте альбомы таджикских исполнителей.'
            }
        },
        props: {
            id: null
        },
        methods: {
            fetchAlbum() {
                store.commit('SHOW_MAIN_OVERLAY');
                fetchAlbum(this.id)
                    .then(album => this.album = album)
                    .finally(_ => {
                        store.commit('HIDE_MAIN_OVERLAY');
                    })
            },
            getLink(resource) {
                return this.album.externalLinks.find(a => a.resource === resource)?.link;
            }
        },
        computed: {
            genres() {
                return concatStrings(this.album.genres.map(alias => alias.local_name), ' ·');
            },
            coverUrl() {
                return getAlbumCoverUrl(this.album.id)
            },
            fullCoverUrl() {
                return getBaseUri() + '/' + getAlbumCoverUrl(this.album.id)
            },
            pageUrl() {
                return window.location.href;
            },
            hashTags() {
                let tags = concatStrings(this.album.artistAliases.map(alias => alias.name), ',') +
                    ',' + this.album.title;
                return tags.replace(/\s/g, '');
            },
        },
        watch: {
            album() {
                let album = this.album.title + '" - ' + concatStrings(this.album.artistAliases.slice(0, 2).map(alias => alias.name), ' ·');
                this.title = 'Слушать, скачать альбом "' + album;
                this.description = 'Слушайте песни, читайте тексты, смотрите клипы музыкального альбома ' + album +
                    ' на Echo.tj';
                this.updateTitle();
                this.updateDescription();
            }
        }
    }
</script>

<style scoped>

</style>
