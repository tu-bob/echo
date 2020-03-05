<template>
    <div>
        <div class="form-group">
            <label for="song">Выберите песню</label>
            <input type="file" id="song" class="form-control" @change="getMetaData">
        </div>
        <div class="form-group">
            <label>Название</label>
            <input type="text" class="form-control" v-model="song.title">
        </div>
        <div>
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
            <label>Лэйбел</label>
            <input type="text" class="form-control" v-model="song.label">
        </div>
    </div>
</template>

<script>
    import SuggestionInput from "../../common/inputs/SuggestionInput";
    import {parseBlob} from 'music-metadata-browser';

    export default {
        name: "SongEditor",
        components: {SuggestionInput},
        data() {
            return {
                artistAliases: [],
                song: {
                    title: null,
                    year: null,
                    genre: null,
                    length: null,
                    artistAliases: []


//album
// name:null,
// type:null,
// artist:null,
// cover:null,
// alt:null,
// released:null,
// recorded:null,
// venue:null,
// studio:null,
// genre:null,
// length:null,
// label:null,
// producer:null,
                }
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
                parseBlob($('#song')[0].files[0])
                    .then(metadata => {
                        console.log(metadata);
                        this.fillData(metadata)
                    })
                    .catch(err => {
                        console.error(err.message);
                    });
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
            }
        },
    }
</script>

<style scoped>

</style>
