<template>
    <b-overlay :show="submitting" rounded="sm">
        <div class="card mb-5">
            <div class="card-header">
                Редактор альбомов
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-5">
                        <label>Название альбома</label>
                        <input class="form-control" type="text" v-model="album.title" autocapitalize="words" autofocus>
                    </div>
                    <div class="form-group col-md-5">
                        <label>Тип</label>
                        <select class="form-control" v-model="album.type">
                            <option disabled :value="null">Выберите тип альбома</option>
                            <option v-for="type in albumTypes" :value="type">{{type.name}}</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label>Год</label>
                        <input class="form-control" type="text" v-model="album.year">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12">
                        <label>Песни</label>
                        <suggestion-input displayPropertyName="title"
                                          ref="songSearch"
                                          @selected="onSongSelected"
                                          :optionFormatter="optionFormatter"
                                          action-url="/media/music/song/find/">
                        </suggestion-input>
                    </div>
                </div>
                <div class="row mt-2">
                    <songs-table class='col-12'
                                 :provided-songs="album.songs"
                                 :columnsToHide="['edit']"
                                 :url="null"
                                 @song-delete-request="removeSong"
                                 preventFetch>
                        <template #header>
                            Песни альбома
                        </template>

                        <template #delete="{song}">
                            <a href="#" @click.prevent="removeSong(song)">
                                <img class="icon-btn-sm" src="/icons/svg/delete.svg">
                            </a>
                        </template>
                    </songs-table>
                </div>
                <div>
                    <image-uploader v-model="albumCoverFile" ref="albumCoverFileInput" :src="coverUrl"
                                    :alt="album.name + ' cover'">
                        <template #header>
                            Обложка альбома
                        </template>
                    </image-uploader>
                </div>
                <span>Ссылки</span>
                <div class="form-group">
                    <b-input-group class="mb-2" prepend="YouTube">
                        <input class="form-control" v-model="album.links.youtube" type="url">
                    </b-input-group>
                    <b-input-group class="mb-2" prepend="Apple Music">
                        <input class="form-control" v-model="album.links.appleMusic" type="url">
                    </b-input-group>
                    <b-input-group class="mb-2" prepend="Yandex Music">
                        <input class="form-control" v-model="album.links.yandexMusic" type="url">
                    </b-input-group>
                    <b-input-group class="mb-2" prepend="Google Music">
                        <input class="form-control" v-model="album.links.googleMusic" type="url">
                    </b-input-group>
                    <b-input-group class="mb-2" prepend="Spotify">
                        <input class="form-control" v-model="album.links.spotify" type="url">
                    </b-input-group>
                </div>
            </div>


            <div class="card-footer">
                <button class="mx-auto btn btn-primary" @click="submit">Сохранить</button>
            </div>
        </div>
    </b-overlay>
</template>

<script>
    import {fetchAlbum, fetchAlbumTypes} from "../../../../api/mediaApi";
    import SongsTable from "../music/SongsTable";
    import ImageUploader from "../../../common/inputs/ImageUploader";
    import ResetErrorsMixin from "../../mixins/ResetErrorsMixin";

    export default {
        name: "AlbumEditor",
        components: {ImageUploader, SongsTable},
        mixins: [ResetErrorsMixin],
        created() {
            this.fetchAlbumTypes();
            if (this.$route.params.id)
                this.fetchAlbum(this.$route.params.id);
        },
        data() {
            return {
                submitting: false,
                albumCoverFile: null,
                albumTypes: [],
                album: {
                    title: null,
                    type: null,
                    year: null,
                    songs: [],
                    links: {
                        youtube: null,
                        appleMusic: null,
                        yandexMusic: null,
                        googleMusic: null,
                        spotify: null
                    }
                },
            }
        },
        methods: {
            fetchAlbumTypes() {
                fetchAlbumTypes().then(types =>
                    this.albumTypes = types
                )
                    .catch();
            },
            removeSong(song) {
                this.album.songs = this.album.songs.filter(item => item.id !== song.id);
            },
            onSongSelected(song) {
                if (song) {
                    let exists = this.album.songs.find((item) => item.id === song.id);
                    if (!exists) {
                        this.album.songs.push(song);
                    }
                }

                this.$refs['songSearch'].query = '';
                this.$refs['songSearch'].options = [];
            },
            optionFormatter(option) {
                let str = option.title + ' - ';
                option.artistAliases.forEach(alias => str += option.artistAliases[0].name + '; ');
                return str;
            },
            submit() {
                this.submitting = true;
                let data = new FormData();
                if (this.album.id)
                    data.append('id', this.album.id);
                if (this.albumCoverFile)
                    data.append('albumCoverFile', this.albumCoverFile, this.albumCoverFile.name);
                data.append('title', this.album.title);
                data.append('year', String(this.album.year));
                if (this.album.type)
                    data.append('type', String(this.album.type.id));

                for (let i = 0; i < this.album.songs.length; i++) {
                    data.append('songs[]', this.album.songs[i].id);
                }

                for (let [resource, link] of Object.entries(this.album.links)) {
                    if (link)
                        data.append('links[' + resource + ']', link)
                }

                axios.post('/media/music/album', data)
                    .then(_ => {
                        this.clearForm();
                        if (this.$route.params.id)
                            this.$router.replace({name: 'album-editor'})
                    })
                    .catch(
                        e => console.log(e)
                    )
                    .then(_ => this.submitting = false);
            },
            fetchAlbum(id) {
                fetchAlbum(id).then(album => {
                    let links = {};
                    for (let i in album.externalLinks) {
                        links[album.externalLinks[i].resource] = album.externalLinks[i].link;
                    }
                    album.links = links;
                    this.album = album;
                }).catch();
            },
            clearForm() {
                this.album.title = null;
                this.album.type = null;
                this.album.year = null;
                this.album.songs = [];
                this.album.id = null;
                this.albumCoverFile = null;
                this.album.links = {
                    youtube: null,
                    appleMusic: null,
                    yandexMusic: null,
                    googleMusic: null,
                    spotify: null
                };
                this.$refs['albumCoverFileInput'].reset();
                this.$store.commit('RESET_HTML_ERRORS');
            }
        },
        computed: {
            coverUrl() {
                if (this.album.id && this.album.cover_id)
                    return `/media/music/album/${this.album.id}/cover`;
            }
        }
    }
</script>

<style scoped>

</style>
