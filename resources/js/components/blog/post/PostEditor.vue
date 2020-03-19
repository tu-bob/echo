<template>
    <div>
        <div class="form-group mx-3">
            <label>Заголовок</label>
            <input class="form-control" v-model="post.title"/>
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

    export default {
        name: "PostEditor",
        components: {Summernote},
        data() {
            return {
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
