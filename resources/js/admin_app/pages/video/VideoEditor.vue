<template>
    <b-overlay :show="submitting" rounded="sm">
        <div class="card">
            <div class="card-header">Редактировать видео</div>
            <div class="card-body">
                <div class="form-group">
                    <label>Название</label>
                    <input class="form-control" v-model="video.title" type="text" placeholder="Название ролика">
                </div>
                <div class="form-group">
                    <label>Тип</label>
                    <select class="form-control" v-model="video.type">
                        <option value="clip">Клип</option>
                        <option value="cover">Кавер</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Ссылка</label>
                    <input class="form-control" v-model="video.src" type="text" placeholder="Ссылка на YouTube">
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" @click="submit">Сохранить</button>
            </div>
        </div>
    </b-overlay>
</template>

<script>
import {getStoreOrUpdateAction} from "../../../main";

export default {
    name: "VideoEditor",
    created() {
        if (this.$route.params.id)
            this.fetchData();
    },
    data() {
        return {
            submitting: false,
            video: {
                title: null,
                type: null,
                src: null,
            }
        }
    },
    props: {
        id: null
    },
    methods: {
        submit() {
            this.submitting = true;
            let action = getStoreOrUpdateAction(this.id, '/media/video');

            axios.post(action.url, this.video)
                .then(_ => {
                    // this.$router.push({name: 'videos-table'})
                })
                .catch(e => console.log(e))
                .finally(_ => {
                    this.submitting = false
                });
        },
        fetchData() {
            axios.get(`/media/video/${this.$route.params.id}`)
                .then(response => this.setData(response))
        },
        setData(video) {
            let links = {};
            for (let i in video.externalLinks) {
                links[video.externalLinks[i].resource] = video.externalLinks[i].link;
            }
            video.links = links;
            this.video = video;
            this.aliases = video.aliases.map(function (alias) {
                return alias.name;
            })
        }
    },
}
</script>

<style scoped>

</style>
