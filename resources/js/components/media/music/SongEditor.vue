<template>
    <div>
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
            <label>Длина</label>
            <input type="text" class="form-control" v-model="song.length">
        </div>
    </div>
</template>

<script>
    import SuggestionInput from "../../common/inputs/SuggestionInput";

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
        }
    }
</script>

<style scoped>

</style>
