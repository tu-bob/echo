<template>
    <div class="col-md-6">
        <h4>Добавить артиста</h4>
        <div class="form-group">
            <label>Название</label>
            <input type="text" class="form-control" v-model="artist.name">
        </div>
        <div class="form-group">
            <label>Синонимы</label>
            <b-form-tags input-id="tags-basic"
                         v-model="aliases"
                         class="mb-2"
                         size="lg"
                         tag-variant="warning"
                         tag-pills
                         add-button-text="Добавить"
                         separator=";"
            ></b-form-tags>
        </div>
        <button class="btn btn-primary" @click="submit">Сохранить</button>
    </div>
</template>

<script>
    export default {
        name: "ArtistEditor",
        data() {
            return {
                artist: {
                    name: null
                },
                aliases: []
            }
        },
        methods: {
            submit() {
                let data = {
                    name: this.artist.name,
                    aliases: this.aliases
                };

                axios.post('/media/artist', data)
                    .then(response => {
                        console.log(response);
                    });
            }
        }
    }
</script>

<style scoped>

</style>
