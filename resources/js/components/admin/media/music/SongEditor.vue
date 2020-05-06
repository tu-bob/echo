<template>
    <b-overlay :show="busy" rounded="sm">
        <div class="card mb-5">
            <div class="card-header">
                Загрузка песни
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="align-items-end col-md-6 form-group" v-if="!Boolean(providedFile)">
                        <label>Файл</label>
                        <b-form-file
                            v-model="mp3File"
                            :state="Boolean(audioSrc) || Boolean(mp3File)"
                            ref="mp3FileInput"
                            accept=".mp3"
                            placeholder="Выберите файл или перетащите его сюда..."
                            drop-placeholder="Перетащите файл сюда..."
                            browse-text="Обзор"
                        ></b-form-file>
                    </div>
                    <div class="row ml-1 col-md-6">
                        <audio ref="songEditorPlayer"
                               class="mt-md-4 mx-auto"
                               controlsList="nodownload"
                               preload="none"
                               :src="audioSrc"
                               controls></audio>
                    </div>
                </div>

                <div class="alert alert-info" v-if="song.bitrate">
                <span>{{song.bitrate / 1000}} kbs |
                {{song.sample_rate}} |
                <span v-if="song.container">{{song.container}} |</span>
                <span v-if="song.encoder">{{song.encoder}} |</span>
                {{duration}}</span>
                </div>

                <div>
                    <image-uploader v-model="coverImageFile" ref="coverImageFile" :src="coverImageUrl" alt="">
                        <template #header>
                            Обложка песни
                        </template>
                    </image-uploader>
                </div>

                <b-input-group>
                    <b-input-group-prepend is-text>
                        <b-form-checkbox switch class="mr-n2" v-model="song.allow_download">
                            <span class="sr-only">Allow download</span>
                        </b-form-checkbox>
                    </b-input-group-prepend>
                    <b-form-input placeholder="Разрешить скачивание"
                                  disabled></b-form-input>
                </b-input-group>

                <hr>
                <span>Ссылки</span>
                <div class="form-group">
                    <b-input-group class="mb-2" prepend="YouTube">
                        <input class="form-control" v-model="song.clip.src" type="url">
                    </b-input-group>
                    <b-input-group class="mb-2" prepend="iTunes">
                        <input class="form-control" v-model="song.links.iTunes" type="url">
                    </b-input-group>
                    <b-input-group class="mb-2" prepend="Yandex Music">
                        <input class="form-control" v-model="song.links.yandexMusic" type="url">
                    </b-input-group>
                    <b-input-group class="mb-2" prepend="Google Music">
                        <input class="form-control" v-model="song.links.googleMusic" type="url">
                    </b-input-group>
                    <b-input-group class="mb-2" prepend="Spotify">
                        <input class="form-control" v-model="song.links.spotify" type="url">
                    </b-input-group>
                </div>
                <hr>
                <div class="row">
                    <div class="form-group col-md-8">
                        <label>Название</label>
                        <input type="text" class="form-control" v-model="song.title" autofocus>
                    </div>
                    <div class="form-group col-md-4 ">
                        <label>Год</label>
                        <input type="text" class="form-control" v-model="song.year">
                    </div>
                </div>

                <div class="form-group">
                    <label>Название на английском</label>
                    <input type="text" class="form-control" v-model="song.english_title" autofocus>
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
                                class="text-decoration-none"
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
                    <label>Жанры</label>
                    <suggestion-input displayPropertyName="name"
                                      ref="genreSearch"
                                      @selected="onGenreSelected"
                                      :providedOptions="genres"
                                      :optionFormatter="formatGenresOptions"
                                      searchPropertyName="searchField">
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
                                class="text-decoration-none"
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
                                class="text-decoration-none"
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

                <div class="form-group">
                    <label>Текст песни</label>
                    <b-form-textarea
                        v-model="song.lyrics"
                        rows="5"
                        max-rows="15"
                    ></b-form-textarea>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" @click="submit">Сохранить</button>
            </div>

        </div>
    </b-overlay>
</template>

<script>
    import {parseBlob} from 'music-metadata-browser';
    import {validateAudio} from '../../../../util/validators.js'
    import {fetchArtistAliasesByName, fetchAlbums, fetchGenres, fetchSong} from '../../../../api/mediaApi.js'
    import * as ss from 'string-similarity';
    import ImageUploader from "../../../common/inputs/ImageUploader";
    import {getSongIconUrl} from "../../../../api/mediaApi";
    import {secondsToFormattedMinutes} from "../../../../util/stringHelper";
    import ResetErrorsMixin from "../../mixins/ResetErrorsMixin";

    export default {
        name: "SongEditor",
        mixins: [ResetErrorsMixin],
        props: {
            providedFile: {
                type: Object,
                default: null
            }
        },
        created() {
            fetchGenres().then(genres => {
                if (genres)
                    this.genres = genres.map(genre => {
                        genre.searchField = genre.local_name + genre.name;
                        return genre;
                    });
                if (this.$route.params.id)
                    this.fetchSong(this.$route.params.id);
            });
        },
        data() {
            return {
                coverImageFile: null,
                missedArtists: [],
                missedAlbums: [],
                mp3File: this.providedFile,
                genres: [],
                busy: false,
                song: {
                    id: null,
                    title: null,
                    english_title: null,
                    clip: {src: null},
                    links: {
                        iTunes: null,
                        yandexMusic: null,
                        googleMusic: null,
                        spotify: null
                    },
                    lyrics: null,
                    year: null,
                    genres: [],
                    length: null,
                    artistAliases: [],
                    albums: [],
                    label: null,
                    bitrate: null,
                    sample_rate: null,
                    container: null,
                    numberOfChannels: null,
                    lossless: null,
                    playtime_seconds: null,
                    allow_download: true
                }
            }
        },
        watch: {
            mp3File() {
                // this.clearForm();
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

                this.$refs['artistSearch'].query = '';
                this.$refs['artistSearch'].options = [];
            },
            onAlbumSelected(album) {
                if (album) {
                    let exists = this.song.albums.find((item) => item.id === album.id);
                    if (!exists)
                        this.song.albums.push(album);
                }

                this.$refs['albumSearch'].query = '';
                this.$refs['albumSearch'].options = [];
            },
            onGenreSelected(genre) {
                if (genre) {
                    let exists = this.song.genres.find((item) => item.id === genre.id);
                    if (!exists) {
                        this.song.genres.push(genre);
                    }
                }

                this.$refs['genreSearch'].query = '';
            },
            getMetaData() {
                parseBlob(this.mp3File)
                    .then(metadata => {
                        this.fillData(metadata)
                    })
                    .catch(
                        //TODO
                    );
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
                fetchAlbums({'title': title})
                    .then(albums => {
                        if (albums && albums.length > 0)
                            this.onAlbumSelected(albums[0]);
                        else
                            this.missedAlbum = title;
                    })
            },
            fetchSong(id) {
                this.busy = true;
                fetchSong(id).then(song => {
                    let links = {};
                    for (let i in song.externalLinks) {
                        links[song.externalLinks[i].resource] = song.externalLinks[i].link;
                    }
                    song.links = links;
                    this.song = song;
                    if (!this.song.clip)
                        this.song.clip = {src: null}
                })
                    .catch(e => {
                        //TODO
                        }
                    )
                .then(_ => this.busy = false);
            },
            submit() {
                this.busy = true;

                let data = new FormData();
                if (this.song.id)
                    data.append('id', this.song.id);

                if (this.mp3File)
                    data.append('mp3File', this.mp3File, this.mp3File.name);

                if (this.coverImageFile)
                    data.append('coverImageFile', this.coverImageFile, this.coverImageFile.name);

                if (this.song.clip.src) {
                    data.append('clip_src', this.song.clip.src.replace('watch?v=', 'embed/'));
                }

                data.append('title', this.song.title);
                data.append('allow_download', this.song.allow_download ? 1 : 0);
                data.append('year', String(this.song.year));

                if (this.song.english_title)
                    data.append('english_title', this.song.english_title);

                if (this.song.label)
                    data.append('label', this.song.label);
                if (this.song.lyrics)
                    data.append('lyrics', this.song.lyrics);

                for (let i = 0; i < this.song.artistAliases.length; i++) {
                    data.append('artistAliases[]', this.song.artistAliases[i].id);
                }

                for (let j = 0; j < this.song.genres.length; j++) {
                    data.append('genres[]', this.song.genres[j].id);
                }

                for (let k = 0; k < this.song.albums.length; k++) {
                    data.append('albums[]', this.song.albums[k].id);
                }

                for (let [resource, link] of Object.entries(this.song.links)) {
                    data.append('links[' + resource + ']', link)
                }


                axios.post('/media/music/song', data)
                    .then(_ => {
                        this.clearForm(true);
                        if (this.$route.params.id)
                            this.$router.replace({name: 'song-editor'})
                    })
                    .catch(e => console.log(e))
                    .then(_ => this.busy = false);
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
                if (meta.common.label && meta.common.label.length > 0)
                    this.song.label = meta.common.label[0];
                this.song.bitrate = meta.format.bitrate;
                this.song.sample_rate = meta.format.sampleRate;
                this.song.container = meta.format.container;
                this.song.numberOfChannels = meta.format.numberOfChannels;
                this.song.playtime_seconds = meta.format.duration;
                this.song.lossless = meta.format.lossless;
                this.song.lyrics = this.getSongLyrics(meta);

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
                        let existing = this.song.genres.find(genre => bestMatch.genre.id === genre.id);
                        if (!existing)
                            this.song.genres.push(bestMatch.genre);
                    }
                }
            },
            getSongLyrics(meta) {
                if (meta.native['ID3v2.3'])
                    return meta.native['ID3v2.3'], meta.native['ID3v2.3'].find(tag => tag.id === 'USLT')?.value?.text
            },
            clearForm(removeFile = false) {
                this.song = {
                    id: null,
                    title: null,
                    english_title: null,
                    lyrics: null,
                    clip: {src: null},
                    year: null,
                    genres: [],
                    length: null,
                    artistAliases: [],
                    albums: [],
                    label: null,
                    bitrate: null,
                    sample_rate: null,
                    container: null,
                    numberOfChannels: null,
                    lossless: null,
                    playtime_seconds: null,
                    links: {
                        iTunes: null,
                        yandexMusic: null,
                        googleMusic: null,
                        spotify: null
                    }
                };
                this.missedAlbums = [];
                this.missedArtists = [];

                if (removeFile) {
                    this.mp3File = null;
                    this.$refs['mp3FileInput'].reset()
                }

                if (removeFile) {
                    this.coverImageFile = null;
                    this.$refs['coverImageFile'].reset()
                }

                this.$refs['songEditorPlayer'].src = null;
                this.$store.commit('RESET_HTML_ERRORS');
            },
            formatGenresOptions(genre) {
                return genre.name + ' - ' + genre.local_name;
            }
        },
        computed: {
            audioSrc() {
                if (this.mp3File)
                    return URL.createObjectURL(this.mp3File);
                if (this.song.cover_image_id)
                    return `/media/music/song/${this.song.id}/audio`;
            },
            coverImageUrl() {
                if (this.song.id)
                    return getSongIconUrl(this.song.id, false);
            },
            duration() {
                return secondsToFormattedMinutes(Math.round(this.song.playtime_seconds));
            },
        },
        components: {ImageUploader}
    }
</script>

<style scoped>

</style>
