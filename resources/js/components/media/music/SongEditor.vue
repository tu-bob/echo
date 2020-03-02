<template>
    <div class="col-md-6">
        <div class="form-group">
            <label>Название</label>
            <input type="text" class="form-control" v-model="song.title">
        </div>
        <div class="form-group">
            <label>Артисты</label>
            <b-form-tags v-model="song.artists" size="lg" add-on-change no-outer-focus class="mb-2">
                <template v-slot="{ tags, inputAttrs, inputHandlers, disabled, removeTag }">
                    <ul v-if="tags.length > 0" class="list-inline d-inline-block mb-2">
                        <li v-for="tag in tags" :key="tag" class="list-inline-item">
                            <b-form-tag
                                @remove="removeTag(tag)"
                                :title="tag.name"
                                :disabled="disabled"
                                variant="warning"
                            >{{ tag.name }}
                            </b-form-tag>
                        </li>
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
    export default {
        name: "SongEditor",
        data() {
            return {
                song: {
                    title: null,
                    artists: [{name:'Далер Назаров'}, {name:'Некруз Аломов'}],
                    year: null,
                    genre: null,
                    length: null,


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
        }
    }
</script>

<style scoped>

</style>
