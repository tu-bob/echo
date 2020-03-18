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
        <div class="row">
            <songs-table class='col-12'
                         :provided-songs="album.songs"
                         :columnsToHide="['edit']"
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
    </div>
</template>

<script>
    import {fetchAlbumTypes} from "../../../api/mediaApi";
    import SongsTable from "../music/SongsTable";

    export default {
        name: "AlbumEditor",
        components: {SongsTable},
        created() {
            this.fetchAlbumTypes();
        },
        data() {
            return {
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
            }
        }
    }
</script>

<style scoped>

</style>
