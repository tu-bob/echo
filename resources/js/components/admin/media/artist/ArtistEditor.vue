<template>
    <b-overlay :show="submitting" rounded="sm">
        <div class="card">
            <div class="card-header">Редактировать исполнителя</div>
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
                <div>
                    <image-uploader v-model="avatarFile" :src="coverUrl"></image-uploader>
                </div>
                <div class="form-group">
                    <label>Тип</label>
                    <select class="form-control" v-model="artist.type">
                        <option value="singer">Исполнитель</option>
                        <option value="band">Группа</option>
                        <option value="composer">Композитор</option>
                        <option value="chorus">Хор</option>
                        <option value="orchestra">Оркестр</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Информация</label>
                    <textarea class="form-control" v-model="artist.info"></textarea>
                </div>
                <h4 class="mt-5">Превью аватарки</h4>
                <div class="row">

                    <b-avatar class="mx-auto" size="200px" :src="avatartUrl">

                    </b-avatar>
                </div>

                <span>Ссылки</span>
                <div class="form-group">
                    <b-input-group class="mb-2" prepend="Instagram">
                        <input class="form-control" v-model="artist.links.instagram" type="url">
                    </b-input-group>
                    <b-input-group class="mb-2" prepend="Facebook">
                        <input class="form-control" v-model="artist.links.facebook" type="url">
                    </b-input-group>
                    <b-input-group class="mb-2" prepend="Vk">
                        <input class="form-control" v-model="artist.links.vk" type="url">
                    </b-input-group>
                    <b-input-group class="mb-2" prepend="YouTube">
                        <input class="form-control" v-model="artist.links.youtube" type="url">
                    </b-input-group>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" @click="submit">Сохранить</button>
            </div>
        </div>
    </b-overlay>
</template>

<script>
    import {getStoreOrUpdateAction} from '../../../../main.js'
    import ResetErrorsMixin from "../../mixins/ResetErrorsMixin";
    import ImageUploader from "../../../common/inputs/ImageUploader";
    import {getAvatarImage} from "../../../../api/mediaApi";

    export default {
        name: "ArtistEditor",
        components: {ImageUploader},
        mixins: [ResetErrorsMixin],
        created() {
            if (this.$route.params.id)
                this.fetchData();
        },
        data() {
            return {
                submitting: false,
                artist: {
                    name: null,
                    type: null,
                    info: null,
                    links: {
                        instagram: null,
                        vk: null,
                        youtube: null,
                        facebook: null
                    }
                },
                avatarFile: null,
                aliases: []
            }
        },
        props: {
            id: null
        },
        methods: {
            submit() {
                this.submitting = true;

                let data = new FormData();
                if (this.id)
                    data.append('id', this.id);

                for (let i = 0; i < this.aliases.length; i++) {
                    data.append('aliases[]', this.aliases[i]);
                }
                // data.append('name',)
                if (this.avatarFile)
                    data.append('avatarFile', this.avatarFile, this.avatarFile.name);

                if (this.artist.type)
                    data.append('type', this.artist.type);

                if (this.artist.info)
                    data.append('info', this.artist.info);

                for (let [resource, link] of Object.entries(this.artist.links)) {
                    if (link)
                        data.append('links[' + resource + ']', link)
                }

                let action = getStoreOrUpdateAction(this.id, '/media/artist');

                axios.post(action.url, data)
                    .then(_ => {
                        this.$router.push({name: 'artists-table'})
                    })
                    .catch(e => console.log(e))
                    .finally(_ => {
                        this.submitting = false
                    });
            },
            fetchData() {
                axios.get(`/media/artist/${this.$route.params.id}`)
                    .then(response => this.setData(response))
            },
            setData(artist) {
                let links = {};
                for (let i in artist.externalLinks) {
                    links[artist.externalLinks[i].resource] = artist.externalLinks[i].link;
                }
                artist.links = links;
                this.artist = artist;
                this.aliases = artist.aliases.map(function (alias) {
                    return alias.name;
                })
            }
        },
        computed: {
            coverUrl() {
                if (this.artist.avatar_id)
                    return getAvatarImage(this.artist.avatar_id);
            },
            avatartUrl() {
                if (this.avatarFile) {
                    return URL.createObjectURL(this.avatarFile);
                } else if (this.coverUrl)
                    return this.coverUrl;
            }
        }
    }
</script>

<style scoped>

</style>
