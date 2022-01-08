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
            this.video._method = action.method
            axios.post(action.url, this.video)
                .then(_ => {
                    this.id = null;
                    this.video = {
                        title: null,
                        type: null,
                        src: null,
                    }
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
            this.video = video;
        }
    },
}
</script>

<style scoped>

</style>
