<template>
    <div>
        <div class="form-group mx-3">
            <label>Заголовок</label>
            <input class="form-control" v-model="post.title"/>
        </div>
        <div class="container">
            <image-uploader v-model="previewImage" :src="previewImageUrl" :alt="post.title">
                <template #header>
                    Фото превью
                </template>
            </image-uploader>
        </div>
        <div class="form-group mx-3">
            <label>Автор</label>
            <!--            <input class="form-control" v-model="post.author"/>-->
            <suggestion-input displayPropertyName="name"
                              queryIsFirstOption
                              :providedQuery="post.author.name"
                              ref="authorSearch"
                              preventFetching="1"
                              @selected="onAuthorSelected"
                              action-url="/blog/author/filter?name=">
            </suggestion-input>
        </div>
        <div class="form-group mx-3">
            <label>Анотация</label>
            <textarea class="form-control" v-model="post.annotation"/>
        </div>
        <div class="col-12 my-4">
            <label>Статья</label>
            <summernote ref="articleEditor" v-model="post.article" imageUploadUrl="/media/image/many"></summernote>
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
    import Summernote from "../../../common/summernote/Summernote";
    import ImageUploader from "../../../common/inputs/ImageUploader";
    import {fetchPost} from "../../../../api/blogApi";

    export default {
        name: "PostEditor",
        components: {ImageUploader, Summernote},
        created() {
            if (this.$route.params.id)
                this.fetchPost(this.$route.params.id);
        },
        data() {
            return {
                previewImage: null,
                post: {
                    title: null,
                    annotation: null,
                    article: null,
                    author: {
                        name: null
                    },
                    reference: null,
                    ref_name: null
                }
            }
        },
        methods: {
            submit() {
                let data = new FormData();
                if (this.post.id)
                    data.append('id', this.post.id);

                data.append('title', this.post.title);
                data.append('author', this.post.author.name);
                data.append('annotation', this.post.annotation);
                data.append('article', this.post.article);
                if (this.post.reference)
                    data.append('reference', this.post.reference);
                if (this.post.ref_name)
                    data.append('ref_name', this.post.ref_name);

                if (this.previewImage)
                    data.append('previewImage', this.previewImage, this.previewImage.name);

                axios.post('/blog/post', data);
            },
            fetchPost(id) {
                fetchPost(id).then(post => {
                    this.post = post;
                    this.$refs['articleEditor'].innerHtml(post.article);
                }).catch();
            },
            onAuthorSelected(author) {
                this.post.author = author;
            }
        },
        computed: {
            previewImageUrl() {
                if (this.post.previewImage)
                    return `/media/image/${this.post.previewImage.id}/blog`;
            }
        }
    }
</script>

<style scoped>

</style>
