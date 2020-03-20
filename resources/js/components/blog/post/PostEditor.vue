<template>
    <div>
        <div class="form-group mx-3">
            <label>Заголовок</label>
            <input class="form-control" v-model="post.title"/>
        </div>
        <div class="container">
            <image-uploader v-model="previewImage">
                <template #header>
                    Фото превью
                </template>
            </image-uploader>
        </div>
        <div class="form-group mx-3">
            <label>Автор</label>
            <input class="form-control" v-model="post.author"/>
        </div>
        <div class="form-group mx-3">
            <label>Анотация</label>
            <textarea class="form-control" v-model="post.annotation"/>
        </div>
        <div class="col-12 my-4">
            <label>Статья</label>
            <summernote v-model="post.article" imageUploadUrl="/media/image/many"></summernote>
        </div>

        <div class="row mx-3">
            <div class="form-group col-md-4">
                <label>Название источника</label>
                <input class="form-control" v-model="post.ref_name"/>
            </div>
            <div class="form-group col-md-8">
                <label>Ссылка на источник</label>
                <input class="form-control" v-model="post.reference"/>
            </div>
        </div>

        <div class="col-12 text-center">
            <button class="btn btn-primary" @click="submit">Сохранить</button>
        </div>
    </div>

</template>

<script>
    import Summernote from "../../common/summernote/Summernote";
    import ImageUploader from "../../common/inputs/ImageUploader";

    export default {
        name: "PostEditor",
        components: {ImageUploader, Summernote},
        data() {
            return {
                previewImage: null,
                post: {
                    title: null,
                    annotation: null,
                    article: null,
                    author: null,
                    reference: null,
                    ref_name: null
                }
            }
        },
        methods: {
            submit() {
                let data = new FormData();
                data.append('title', this.post.title);
                data.append('author', this.post.author);
                data.append('annotation', this.post.annotation);
                data.append('article', this.post.article);
                data.append('reference', this.post.reference);
                data.append('ref_name', this.post.ref_name);
                data.append('previewImage', this.previewImage, this.previewImage.name);

                axios.post('/blog/post', data);
            }
        },
    }
</script>

<style scoped>

</style>
