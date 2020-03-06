<template>
    <div class="col-md-8">
        <div class="form-group" v-if="!Boolean(providedFile)">
            <b-form-file
                v-model="mp3File"
                :state="Boolean(mp3File)"
                accept=".mp3"
                placeholder="Выберите файл или перетащите его сюда..."
                drop-placeholder="Перетащите файл сюда..."
                browse-text="Обзор"
            ></b-form-file>
        </div>
        <div class="alert alert-info" v-if="mp3File">
            <span>{{song.bitrate / 1000}} kbs | {{song.sampleRate}} | {{song.container}} | {{Math.round(song.duration / 60 *100) / 100}}</span>
        </div>
        <div class="form-group">
            <label>Название</label>
            <input type="text" class="form-control" v-model="song.title" autofocus>
        </div>
        <div class="form-group">
            <label>Исполнители</label>
            <suggestion-input displayPropertyName="name"
                              ref="artistSearch"
                              @selected="onArtistSelected"
                              action-url="/media/artist/alias/filter?name=">
            </suggestion-input>
            <ul
                class="list-unstyled d-inline-flex flex-wrap mb-0"
                aria-live="polite"
                aria-atomic="false"
                aria-relevant="additions removals"
            >
                <b-card
                    v-for="artistAlias in song.artistAliases"
                    :key="artistAlias.id"
                    :id="`artistAliasesTagList_${artistAlias.name.replace(/\s/g, '_')}_`"
                    tag="li"
                    class="mt-1 mr-1 bg-warning"
                    body-class="py-1 pr-2 text-nowrap"
                >
                    <strong>{{ artistAlias.name }}</strong>
                    <b-button
                        @click="removeArtistAlias(artistAlias.id)"
                        variant="link"
                        size="sm"
                        :aria-controls="`artistAliasesTagList__${artistAlias.name.replace(/\s/g, '_')}_`"
                    >&times;
                    </b-button>
                </b-card>
            </ul>

            <span v-if="missedArtists.length > 0" class="small">Исполнители не найдены:
                <b v-for="artist in missedArtists">{{artist}}</b>
            </span>
        </div>
        <div class="form-group">
            <label>Год</label>
            <input type="text" class="form-control" v-model="song.year">
        </div>

        <div class="form-group">
           <label>Жанры</label>
            <suggestion-input displayPropertyName="name"
                              ref="genreSearch"
                              @selected="onGenreSelected"
                              :providedOptions="genres"
                              searchPropertyName="name">
            </suggestion-input>
            <ul
                class="list-unstyled d-inline-flex flex-wrap mb-0"
                aria-live="polite"
                aria-atomic="false"
                aria-relevant="additions removals"
            >
                <b-card
                    v-for="genre in song.genres"
                    :key="genre.id"
                    :id="`genresTagList_${genre.id.replace(/\s/g, '_')}_`"
                    tag="li"
                    class="mt-1 mr-1 bg-warning"
                    body-class="py-1 pr-2 text-nowrap"
                >
                    <strong>{{ genre.name }}</strong>
                    <b-button
                        @click="removeGenre(genre.id)"
                        variant="link"
                        size="sm"
                        :aria-controls="`genresTagList__${genre.id.replace(/\s/g, '_')}_`"
                    >&times;
                    </b-button>
                </b-card>
            </ul>
        </div>

        <div class="form-group">
            <label>Альбомы</label>
            <suggestion-input displayPropertyName="title"
                              ref="albumSearch"
                              @selected="onAlbumSelected"
                              action-url="/media/music/album/filter?title=">
            </suggestion-input>
            <ul
                class="list-unstyled d-inline-flex flex-wrap mb-0"
                aria-live="polite"
                aria-atomic="false"
                aria-relevant="additions removals"
            >
                <b-card
                    v-for="album in song.albums"
                    :key="album.id"
                    :id="`albumsTagList_${album.id.replace(/\s/g, '_')}_`"
                    tag="li"
                    class="mt-1 mr-1 bg-warning"
                    body-class="py-1 pr-2 text-nowrap"
                >
                    <strong>{{ album.title }}</strong>
                    <b-button
                        @click="removeAlbum(album.id)"
                        variant="link"
                        size="sm"
                        :aria-controls="`albumsTagList__${album.id.replace(/\s/g, '_')}_`"
                    >&times;
                    </b-button>
                </b-card>
            </ul>
        </div>
        <div class="form-group">
            <label>Лэйбл</label>
            <input type="text" class="form-control" v-model="song.label">
        </div>

        <button class="btn btn-primary" @click="submit">Сохранить</button>
    </div>
</template>

<script>
    import SuggestionInput from "../../common/inputs/SuggestionInput";
    import {parseBlob} from 'music-metadata-browser';
    import {validateAudio} from '../../../util/validators.js'
    import {fetchGenres, fetchArtistAliasesByName, fetchFilteredAlbums} from '../../../api/mediaApi.js'
    import * as ss from 'string-similarity';

    export default {
        name: "SongEditor",
        components: {SuggestionInput},
        props: {
            providedFile: {
                type: Object,
                default: null
            }
        },
        created() {
            fetchGenres().then(genres => {
                if (genres)
                    this.genres = genres
            });
        },
        data() {
            return {
                missedArtists: [],
                missedAlbums: [],
                mp3File: this.providedFile,
                genres: [],
                song: {
                    title: null,
                    year: null,
                    genres: [],
                    length: null,
                    artistAliases: [],
                    albums: [],
                    label: null,
                    bitrate: null,
                    sampleRate: null,
                    container: null,
                    numberOfChannels: null,
                    lossless: null,
                    duration: null
                }
            }
        },
        watch: {
            mp3File() {
                if (this.mp3File && validateAudio(this.mp3File))
                    this.getMetaData();
                else this.mp3File = null;
            }
        },
        methods: {
            onArtistSelected(artist) {
                if (artist) {
                    let exists = this.song.artistAliases.find((alias) => alias.id === artist.id);
                    if (!exists) {
                        this.song.artistAliases.push(artist);
                    }
                }

                this.$refs.artistSearch.query = '';
                this.$refs.artistSearch.options = [];
            },
            onAlbumSelected(album) {
                if (album) {
                    this.song.albums.push(album);
                }

                this.$refs.albumSearch.query = '';
                this.$refs.albumSearch.options = [];
            },
            onGenreSelected(genre) {
                if (genre) {
                    let exists = this.song.genres.find((item) => item.id === genre.id);
                    if (!exists) {
                        this.song.genres.push(genre);
                    }
                }

                this.$refs.genreSearch.query = '';
                this.$refs.genreSearch.options = [];
            },
            getMetaData() {
                parseBlob(this.mp3File)
                    .then(metadata => {
                        console.log(metadata)
                        this.fillData(metadata)
                    })
                    .catch(err => {
                        console.log(err)
                    });
            },
            fetchArtist(name) {
                fetchArtistAliasesByName(name).then(aliases => {
                    if (aliases && aliases.length > 0)
                        this.onArtistSelected(aliases[0]);
                    else
                        this.missedArtists.push(name);
                })
            },
            fetchAlbum(title) {
                fetchFilteredAlbums({'title': title})
                    .then(albums => {
                        if (albums && albums.length > 0)
                            this.onAlbumSelected(albums[0]);
                        else
                            this.missedAlbum = title;
                    })
            },
            submit() {
                let data = new FormData();
                data.append('id', this.song.id);
                data.append('mp3File', this.mp3File, this.mp3File.name);
                data.append('title', this.song.title);
                data.append('year', String(this.song.year));
                data.append('label', this.song.label);

                for (let i = 0; i < this.song.artistAliases.length; i++) {
                    data.append('artistAliases[]', this.song.artistAliases[i].id);
                }

                for (let i = 0; i < this.song.genres.length; i++) {
                    data.append('genres[]', this.song.genres[i].id);
                }

                axios.post('/media/music/song', data)
                // .then(this.$router.go());
            },
            removeArtistAlias(id) {
                this.song.artistAliases = this.song.artistAliases.filter(alias => alias.id !== id);
            },
            removeAlbum(id) {
                this.song.albums = this.song.albums.filter(album => album.id !== id);
            },
            removeGenre(id) {
                this.song.genres = this.song.genres.filter(genre => genre.id !== id);
            },
            fillData(meta) {
                this.song.title = meta.common.title;
                this.song.year = meta.common.year;
                this.song.label = meta.common.label[0];
                this.song.bitrate = meta.format.bitrate;
                this.song.sampleRate = meta.format.sampleRate;
                this.song.container = meta.format.container;
                this.song.numberOfChannels = meta.format.numberOfChannels;
                this.song.duration = meta.format.duration;
                this.song.lossless = meta.format.lossless;

                if (meta.common.artists)
                    for (let i = 0; i < meta.common.artists.length; i++) {
                        this.fetchArtist(meta.common.artists[i]);
                    }

                if (meta.common.album)
                    this.fetchAlbum(meta.common.album);

                if (meta.common.genre) {
                    for (let j = 0; j < meta.common.genre.length; j++) {
                        let genreName = meta.common.genre[j].replace(/[^a-zA-Z]/g, '').toUpperCase();
                        let bestMatch = {score: 0, genre: null};

                        for (let k = 0; k < this.genres.length; k = k + 1) {
                            let enScore = ss.compareTwoStrings(
                                genreName,
                                this.genres[k].name.replace(/[^a-zA-Z]/g, '').toUpperCase()
                            );

                            let ruScore = ss.compareTwoStrings(
                                genreName,
                                this.genres[k].local_name.replace(/[^\u0410-\u042F\u0430-\u044F]/g, '').toUpperCase()
                            );

                            let score = enScore > ruScore ? enScore : ruScore;

                            if (score > bestMatch.score) {
                                bestMatch.score = score;
                                bestMatch.genre = this.genres[k];
                            }
                        }

                        this.song.genres.push(bestMatch.genre);
                    }
                }
            }
        },
    }
</script>

<style scoped>

</style>
