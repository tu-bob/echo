<template>
    <div class="col-md-8">
        <div class="form-group" v-if="!Boolean(providedFile)">
            <b-form-file
                v-model="file"
                :state="Boolean(file)"
                accept=".mp3, .ogg, .wav"
                placeholder="Выберите файл или перетащите его сюда..."
                drop-placeholder="Перетащите файл сюда..."
                browse-text="Обзор"
            ></b-form-file>
        </div>
        <div class="alert alert-info" v-if="file">
            <span>{{song.bitrate / 1000}} kbs | {{song.sampleRate}} | {{song.container}} | {{Math.round(song.duration / 60 *100) / 100}}</span>
        </div>
        <div class="form-group">
            <label>Название</label>
            <input type="text" class="form-control" v-model="song.title" autofocus>
        </div>
        <div>
            <label>Исполнители</label>
            <b-form-tags v-model="artistAliases" no-outer-focus class="mb-2">
                <template v-slot="{ tags, inputAttrs, inputHandlers, addTag, removeTag }">
                    <b-input-group aria-controls="my-custom-tags-list">
                        <suggestion-input displayPropertyName="name"
                                          ref="artistSearch"
                                          @selected="onArtistSelected"
                                          action-url="/media/artist/alias/filter?name="></suggestion-input>
                    </b-input-group>
                    <ul
                        id="my-custom-tags-list"
                        class="list-unstyled d-inline-flex flex-wrap mb-0"
                        aria-live="polite"
                        aria-atomic="false"
                        aria-relevant="additions removals"
                    >
                        <!-- Always use the tag value as the :key, not the index! -->
                        <!-- Otherwise screen readers will not read the tag
                             additions and removals correctly -->
                        <b-card
                            v-for="tag in tags"
                            :key="tag"
                            :id="`my-custom-tags-tag_${tag.replace(/\s/g, '_')}_`"
                            tag="li"
                            class="mt-1 mr-1"
                            body-class="py-1 pr-2 text-nowrap"
                        >
                            <strong>{{ tag }}</strong>
                            <b-button
                                @click="removeTag(tag)"
                                variant="link"
                                size="sm"
                                :aria-controls="`my-custom-tags-tag_${tag.replace(/\s/g, '_')}_`"
                            >&times;
                            </b-button>
                        </b-card>
                    </ul>
                </template>
            </b-form-tags>
            <span v-if="missedArtists.length > 0" class="small">Исполнители не найдены:
                <b v-for="artist in missedArtists">{{artist}}</b>
            </span>
        </div>
        <div class="form-group">
            <label>Год</label>
            <input type="text" class="form-control" v-model="song.year">
        </div>
        <div>
            <select v-model="song.genres" multiple class="form-control">
                <option v-for="genre in genres" :value="genre" :key="genre.id">{{genre.name}} {{genre.local_name}}
                </option>
            </select>
            <div class="my-3">Selected: <strong v-for="genre in song.genres">{{ genre.name }} </strong></div>
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
    import {fetchGenres, fetchArtistAliasesByName} from '../../../util/apiCalls.js'
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
                artistAliases: [],
                missedArtists: [],
                file: this.providedFile,
                genres: [],
                song: {
                    title: null,
                    year: null,
                    genres: [],
                    length: null,
                    artistAliases: [],
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
            file() {
                if (this.file && validateAudio(this.file))
                    this.getMetaData();
                else this.file = null;
            }
        },
        methods: {
            onArtistSelected(artist) {
                if (artist) {
                    let exists = this.song.artistAliases.find((alias) => alias.id === artist.id);
                    if (!exists) {
                        this.song.artistAliases.push(artist);
                        this.artistAliases.push(artist.name);
                    }
                }

                this.$refs.artistSearch.query = '';
                this.$refs.artistSearch.options = [];
            },
            getMetaData() {
                parseBlob(this.file)
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
            submit() {
                let data = new FormData();
                data.append('id', this.song.id);
                data.append('file', this.file, this.file.name);
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
