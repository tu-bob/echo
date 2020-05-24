<template>
    <b-container fluid="md" class="mt-4" v-if="album">
        <b-row>
            <b-col md="4" lg="3">
                <div class="w-100 sticky-top pt-5" style="z-index: 0">
                    <safe-image
                        class="w-100 mx-auto"
                        style="max-width: 350px"
                        :src="coverUrl">
                    </safe-image>
                    <h3 class="mt-3 typography-footnote-emphasized text-uppercase text-secondary">
                        {{album.type.name}}</h3>
                </div>
            </b-col>
            <b-col md="8" lg="9" class="pl-md-5 pt-5">
                <h1 class="typography-title-emphasized text-white">{{album.title}}</h1>
                <h2 class="typography-title text-violet">{{aliases}}</h2>
                <h3 class="typography-footnote-emphasized text-uppercase text-secondary">
                    {{genres}} · {{album.year}}</h3>
                <songs-list :playlist="album.songs" class="pt-4"></songs-list>
            </b-col>
        </b-row>

            <div class="d-flex w-100 flex-wrap justify-content-end mt-5">
                <a v-if="getLink('googleMusic')" :href="getLink('googleMusic')">
                    <img width="220px" class="mr-3 mb-3" src="/icons/png/google-play-logo.png">
                </a>
                <a v-if="getLink('yandexMusic')" :href="getLink('yandexMusic')">
                    <img width="260px" class="mr-3 mb-3 link-border" src="/icons/svg/yandex-music-logo.svg">
                </a>
                <a v-if="getLink('appleMusic')" :href="getLink('appleMusic')">
                    <img width="280px" class="mr-3 mb-3" src="/icons/svg/apple-music-logo.svg">
                </a>
                <a v-if="getLink('spotify')" :href="getLink('spotify')">
                    <img width="220px" class="mr-3 mb-3" src="/icons/png/spotify-logo.png">
                </a>
                <a v-if="getLink('youtube')" :href="getLink('youtube')">
                    <img width="220px" class="mr-3 mb-3" src="/icons/png/youtube-logo.png">
                </a>

            </div>
    </b-container>
</template>

<script>
    import SafeImage from "../../common/image/SafeImage";
    import {fetchAlbum, getAlbumCoverUrl} from "../../../api/mediaApi";
    import {store} from "../../../store";
    import {concatStrings} from "../../../util/stringHelper";
    import SongsList from "../../common/music/song/SongsList";

    export default {
        name: "AlbumView",
        mounted() {
            this.fetchAlbum();
        },
        components: {SongsList, SafeImage},
        data() {
            return {
                album: null
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
                    .finally(_ => store.commit('HIDE_MAIN_OVERLAY'))
            },
            getLink(resource) {
                return this.album.externalLinks.find(a => a.resource === resource)?.link;
            }
        },
        computed: {
            aliases() {
                return concatStrings(this.album.artistAliases.map(alias => alias.name), ' ·');
            },
            genres() {
                return concatStrings(this.album.genres.map(alias => alias.local_name), ' ·');
            },
            coverUrl() {
                return getAlbumCoverUrl(this.album.id)
            }
        }
    }
</script>

<style scoped>
    .typography-title-emphasized {
        font-size: 24px;
        line-height: 1.16667;
        font-weight: 600;
        letter-spacing: .007em;
    }

    .typography-title {
        font-size: 24px;
        line-height: 1.16667;
        font-weight: 400;
        letter-spacing: .007em;
    }

    .typography-footnote-emphasized {
        font-size: 12px;
        line-height: 1.18182;
        font-weight: 500;
        letter-spacing: .006em;
    }

    .link-border {
        border: 1px solid white;
        border-radius: 14px;
    }
</style>
