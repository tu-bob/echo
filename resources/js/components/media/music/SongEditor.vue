<template>
    <div>
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
        <div class="form-group">
            <label>Название</label>
            <input type="text" class="form-control" v-model="song.title">
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
        <div class="form-group">
            <label>Жанр</label>
            <input type="text" class="form-control" v-model="song.genre">
        </div>
        <div class="form-group">
            <label>Лэйбл</label>
            <input type="text" class="form-control" v-model="song.label">
        </div>
    </div>
</template>

<script>
    import SuggestionInput from "../../common/inputs/SuggestionInput";
    import {parseBlob} from 'music-metadata-browser';
    import {validateAudio} from '../../../util/validators.js'
    import {fetchGenres, fetchArtistAliasesByName} from '../../../util/apiCalls.js'

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
            fetchGenres().then(genres => this.genres = genres);
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
                    genre: null,
                    length: null,
                    artistAliases: []
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
                        // console.log(metadata)
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
            fillData(meta) {
                this.song.title = meta.common.title;
                this.song.year = meta.common.year;
                this.song.label = meta.common.label;
                this.song.bitrate = meta.bitrate;
                this.song.sampleRate = meta.sampleRate;
                this.song.container = meta.container;
                this.song.numberOfChannels = meta.numberOfChannels;
                this.song.duration = meta.duration;
                this.song.lossless = meta.lossless;

                if (meta.common.artists)
                    for (let i = 0; i < meta.common.artists.length; i++) {
                        this.fetchArtist(meta.common.artists[i]);
                    }
            }
        },
    }
</script>

<style scoped>

</style>
