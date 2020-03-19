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
            <input class="form-control" v-model="post.title"/>
        </div>
        <div class="col-12 mb-4">
            <summernote imageUploadUrl="/media/image/many"></summernote>
        </div>
        <div class="form-group mx-3">
            <label>Ссылка на источник</label>
            <input class="form-control" v-model="post.reference"/>
        </div>
        <div class="col-12 text-center">
            <button class="btn btn-primary">Сохранить</button>
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
                    author: null,
                    reference: null
                }
            }
        }
    }
</script>

<style scoped>

</style>
