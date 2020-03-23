<template>
    <div class="card">
        <div class="card-header">Редактир исполнителей</div>
        <div class="card-body">
            <div class="form-group">
                <label>Имя или псевдонимы</label>
                <b-form-tags input-id="tags-basic"
                             v-model="aliases"
                             class="mb-2"
                             size="lg"
                             tag-variant="warning"
                             placeholder="Добавьте имя или псевдоним"
                             tag-pills
                             add-button-text="Добавить"
                             separator=";"
                ></b-form-tags>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" @click="submit">Сохранить</button>
        </div>

    </div>
</template>

<script>
    import {getStoreOrUpdateAction} from '../../../../main.js'

    export default {
        name: "ArtistEditor",
        created() {
            if (this.$route.params.id)
                this.fetchData();
        },
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
                    id: this.$route?.params?.id,
                    name: this.artist.name,
                    aliases: this.aliases
                };

                let action = getStoreOrUpdateAction(this.$route?.params?.id, '/media/artist/');

                axios({
                    method: action.method,
                    url: action.url,
                    data: data
                })
                    .then(response => {
                        this.$router.go()
                    });
            },
            fetchData() {
                axios.get(`/media/artist/${this.$route.params.id}`)
                    .then(response => this.setData(response))
            },
            setData(data) {
                this.artist = data;
                this.aliases = data.aliases.map(function (alias) {
                    return alias.name;
                })
            }
        }
    }
</script>

<style scoped>

</style>
