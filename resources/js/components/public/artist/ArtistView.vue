<template>
    <b-container fluid="md mt-5" v-if="artist">
        <div class="d-flex flex-wrap mb-5">
            <div style="width:200px"
                 class="mr-5 mb-4">
                <b-avatar size="200px"
                          variant="dark"
                          :src="avatarUrl">
                </b-avatar>
                <div class="d-flex justify-content-center mt-3">
                    <network-share
                        :url="pageUrl"
                        :title="title"
                        :description="description"
                        quote="Echo.tj - Музыкальное наследие Таджикистана"
                        :media="fullAvatarUrl"
                        :hash-tags="hashTags">
                    </network-share>
                </div>
            </div>

            <div>
                <h1 class="typography-header-emphasized text-white">{{ artist.aliases[0].name }}</h1>
                <h2 class="typography-title text-secondary" v-if="aliases && aliases.length > 0">{{ aliases }}</h2>
                <!--                <h2 class="typography-title text-secondary" v-if="translateType(artist.type)">-->
                <!--                    {{translateType(artist.type)}}</h2>-->
                <ul class="social-icons">
                    <li class="mr-1">
                        <instagram v-if="getLink('instagram')"
                                   :url="getLink('instagram')"
                                   title="Следите за новостями исполнителя в инстаграме">
                        </instagram>
                    </li>
                    <li class="mr-1">
                        <facebook v-if="getLink('facebook')"
                                  :url="getLink('facebook')"
                                  title="Следите за новостями исполнителя на фейсбуке">
                        </facebook>
                    </li>
                    <li class="mr-1">
                        <youtube v-if="getLink('youtube')"
                                 :url="getLink('youtube')"
                                 title="Клипы, влоги и выступления смотрите только на официальном ютуб канале">
                        </youtube>
                    </li>
                    <li>
                        <vkontakte v-if="getLink('vk')"
                                   :url="getLink('vk')"
                                   title="Будьте с исполнителем Вконтакте">
                        </vkontakte>
                    </li>
                    <!--                    <a :href="getLink('vk')" v-if="getLink('vk')"><img class="icon-btn-md ml-2"-->
                    <!--                                                          title="Следите за новостями исполнителя в вконтакте"-->
                    <!--                                                          src="/icons/svg/vk.svg"></a>-->
                </ul>
                <div v-if="artist.info">
                    <pre ref="artistInfo" style="color: #6c757d;
                                                margin-top: 1rem;
                                                margin-bottom: 0.25rem;
                                                font-size: 16px;">
                        {{ artist.info }}</pre>
                </div>
            </div>
        </div>
        <div v-if="artist.albums && artist.albums.length > 0">
            <h2 class="typography-title text-secondary mt-5 mb-4">Альбомы</h2>
            <b-row>
                <album-card class="col-sm-6 col-md-4 col-lg-3 mb-4"
                            v-for="album in artist.albums"
                            :key="album.id"
                            :album="album">
                </album-card>
            </b-row>
        </div>
        <div v-if="artist.songs && artist.songs.length > 0">
            <h2 class="typography-title text-secondary mt-5 mb-4">Песни</h2>
            <div class="row">
                <songs-list :playlist="artist.songs.slice(0, Math.ceil(artist.songs.length/2))"
                            no-fetch
                            prevent-play
                            @play="playSong"
                            class="px-3"
                            :class="{'col-md-6':artist.songs.length > 1, 'col-12':artist.songs.length < 2}"
                ></songs-list>
                <songs-list :playlist="artist.songs.slice(Math.ceil(artist.songs.length/2))"
                            no-fetch
                            prevent-play
                            @play="playSong"
                            class="col-md-6 px-3"></songs-list>
            </div>
        </div>
        <div v-if="artist.clips && artist.clips.length > 0">
            <h2 class="typography-title text-secondary mt-5 mb-4">Видео</h2>
            <b-row>
                <video-card v-for="clip in artist.clips" @play="showVideoModal" :video="clip" :key="clip.id"
                            class="col-sm-6 col-md-4 col-lg-3 mb-4"></video-card>
            </b-row>
        </div>

        <div v-if="selectedVideo">
            <b-modal id="modal-video-player"
                     class="bg-transparent"
                     centered
                     :title="selectedVideo.title"
                     header-bg-variant="dark"
                     header-text-variant="light"
                     body-bg-variant="dark"
                     body-text-variant="light"
                     hide-footer
                     size="xl"
                     content-class="border-0"
                     header-class="border-0"
                     ok-only>
                <b-embed
                    type="iframe"
                    aspect="16by9"
                    :src="selectedVideo.src"
                    allowfullscreen
                ></b-embed>
            </b-modal>
        </div>
    </b-container>
</template>

<script>
import {concatStrings, getBaseUri} from "../../../util/stringHelper";
import AlbumCard from "../../common/music/album/AlbumCard";
import SongsList from "../../common/music/song/SongsList";
import VideosList from "../../common/video/VideosList";
import VideoCard from "../../common/video/VideoCard";
import {getAvatarImage} from "../../../api/mediaApi";
import MetaTagsMixin from "../../admin/mixins/MetaTagsMixin";
import NetworkShare from "../../common/inputs/NetworkShare";
import Instagram from "../../common/external-icons/instagram";
import Facebook from "../../common/external-icons/facebook";
import Youtube from "../../common/external-icons/youtube";
import Vkontakte from "../../common/external-icons/vkontakte";

export default {
    name: "ArtistView",
    props: {
        id: null
    },
    mixins: [MetaTagsMixin],
    components: {
        Vkontakte,
        Youtube,
        Facebook,
        Instagram,
        NetworkShare,
        VideoCard,
        VideosList,
        SongsList,
        AlbumCard
    },
    data() {
        return {
            artist: null,
            selectedVideo: null,
            showArtistInfo: false,
            title: "Песни, альбомы, тексты, клипы и аккорды таджикских артистов",
            description: 'Полная информация о творчестве таджикских исполнителей'
        }
    },
    mounted() {
        this.fetchArtist();
    },
    methods: {
        fetchArtist() {
            axios.get('/media/alias-artist/' + this.id)
                .then(artist => this.artist = artist)
        },
        translateType(type) {
            let types = {
                singer: 'Исполнитель',
                band: 'Группа',
                composer: 'Композитор',
                chorus: 'Хор',
                orchestra: 'Оркестр',
            };

            return types[type];
        },
        showVideoModal(video) {
            this.selectedVideo = video;
            this.$nextTick(
                () => this.$bvModal.show('modal-video-player')
            )
        },
        playSong(song) {
            this.$store.commit('UPDATE_PLAYLIST', this.artist.songs);
            this.$store.commit('SET_ACTIVE_SONG', song);
        },
        getLink(resource) {
            return this.artist.externalLinks.find(a => a.resource === resource)?.link;
        }
    },
    computed: {
        aliases() {
            return concatStrings(this.artist.aliases.slice(1, this.artist.aliases.length).map(alias => alias.name), ' ·');
        },
        hashTags() {
            let tags = concatStrings(this.artist.aliases.map(alias => alias.name), ',');
            return tags.replace(/\s/g, '');
        },
        avatarUrl() {
            if (this.artist.avatar_id)
                return getAvatarImage(this.artist.avatar_id);
        },
        fullAvatarUrl() {
            return getBaseUri() + '/' + this.avatarUrl
        },
        pageUrl() {
            return window.location.href;
        }
    },
    watch: {
        artist() {
            this.title = concatStrings(this.artist.aliases.map(alias => alias.name), ' ·') + ' - песни, альбомы, аккорды, тексты песен.';
            this.description = 'Профиль ' + concatStrings(this.artist.aliases.map(alias => alias.name), ' ·') + ' на Echo.tj.' +
                ' Слушайте и скачивайте песни и альбомы. Смотрите видео, изучайте тексты и аккорды в профиле артистов.';
            this.updateTitle();
            this.updateDescription();
        }
    }
}
</script>
