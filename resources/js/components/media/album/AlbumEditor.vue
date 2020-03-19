<template>
    <div class="container">
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

        <div class="row form-group mt-4">
            <div class="col-md-10">
                <label>Обложка альбома</label>
                <b-form-file
                    v-model="albumCoverFile"
                    :state="Boolean(imageSrc) || Boolean(albumCoverFile)"
                    ref="albumCoverFileInput"
                    accept="image/jpeg, image/png"
                    placeholder="Выберите картинку или перетащите ее сюда..."
                    drop-placeholder="Перетащите обложку сюда..."
                    browse-text="Обзор"
                ></b-form-file>
            </div>
            <div class="col-md-2">
                <b-img thumbnail
                       fluid
                       width="100"
                       height="100"
                       :src="imageSrc"
                       :blank="!Boolean(imageSrc)"
                       :alt="album.name + ' cover'"
                ></b-img>
            </div>
        </div>

        <div class="row mt-4">
            <button class="mx-auto btn btn-primary" @click="submit">Сохранить</button>
        </div>
    </div>
</template>

<script>
    import {fetchAlbum, fetchAlbumTypes} from "../../../api/mediaApi";
    import SongsTable from "../music/SongsTable";

    export default {
        name: "AlbumEditor",
        components: {SongsTable},
        created() {
            this.fetchAlbumTypes();
            if (this.$route.params.id)
                this.fetchAlbum(this.$route.params.id);
        },
        data() {
            return {
                albumCoverFile: null,
                albumTypes: [],
                album: {
                    title: null,
                    type: null,
                    year: null,
                    songs: []
                }
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
                let data = new FormData();
                if (this.album.id)
                    data.append('id', this.album.id);
                if (this.albumCoverFile)
                    data.append('albumCoverFile', this.albumCoverFile, this.albumCoverFile.name);
                data.append('title', this.album.title);
                data.append('year', String(this.album.year));
                data.append('type', String(this.album.type.id));

                for (let i = 0; i < this.album.songs.length; i++) {
                    data.append('songs[]', this.album.songs[i].id);
                }

                axios.post('/media/music/album', data)
                    .then(response => {
                        this.clearForm();
                        this.$router.replace('/media/album')
                    })
                    .catch(
                        //TODO
                    );
            },
            fetchAlbum(id) {
                fetchAlbum(id).then(album => {
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
                this.$refs['albumCoverFileInput'].reset();
            }
        },
        computed: {
            imageSrc() {
                if (this.albumCoverFile) {
                    return  URL.createObjectURL(this.albumCoverFile);
                } else if (this.album.id)
                    return `/media/music/album/${this.album.id}/cover`;
            }
        }
    }
</script>

<style scoped>

</style>
