<template>
    <b-overlay :show="submitting" rounded="sm">
        <div class="card mb-5">
            <div class="card-header">Редактор постов</div>
            <div class="card-body">
                <div class="form-group mx-3">
                    <label>Заголовок</label>
                    <input class="form-control" v-model="post.title"/>
                </div>
                <div class="container">
                    <image-uploader ref="post-image-uploader" v-model="previewImage" :src="previewImageUrl"
                                    :alt="post.title">
                        <template #header>
                            Фото превью
                        </template>
                    </image-uploader>
                </div>
                <div class="form-group mx-3">
                    <label>Категория</label>
                    <select class="form-control custom-select" v-model="post.category">
                        <option :value="null" disabled>-- Выберите категорию --</option>
                        <option v-for="category in categories" :value="category" :key="category.id">{{category.name}}
                        </option>
                    </select>
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
                    <summernote ref="articleEditor" v-model="post.article"
                                imageUploadUrl="/api/image-gallery/files"></summernote>
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
            </div>

            <div class="card-footer">
                <button class="btn btn-primary" @click="submit">Сохранить</button>
            </div>
        </div>
    </b-overlay>
</template>

<script>
    import Summernote from "../../../common/summernote/Summernote";
    import ImageUploader from "../../../common/inputs/ImageUploader";
    import {fetchCategories, fetchPost} from "../../../../api/blogApi";
    import ResetErrorsMixin from "../../mixins/ResetErrorsMixin";

    export default {
        name: "PostEditor",
        components: {ImageUploader, Summernote},
        mixins: [ResetErrorsMixin],
        created() {
            this.fetchCategories();
            if (this.$route.params.id)
                this.fetchPost(this.$route.params.id);
        },
        data() {
            return {
                submitting: false,
                previewImage: null,
                categories: [],
                post: {
                    category: null,
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
                this.submitting = true;
                let data = new FormData();
                if (this.post.id)
                    data.append('id', this.post.id);

                data.append('title', this.post.title);
                data.append('author', this.post.author.name);
                data.append('annotation', this.post.annotation);
                data.append('article', this.post.article);
                if (this.post.category)
                    data.append('category', this.post.category.id);
                if (this.post.reference)
                    data.append('reference', this.post.reference);
                if (this.post.ref_name)
                    data.append('ref_name', this.post.ref_name);

                if (this.previewImage)
                    data.append('previewImage', this.previewImage, this.previewImage.name);

                axios.post('/blog/post', data).then(
                    _ => {
                        this.clearForm()
                        if (this.$route.params.id)
                            this.$router.replace({name: 'post-editor'})
                    }
                )
                    .catch(e => console.log(e))
                    .then(_ => this.submitting = false);
            },
            fetchPost(id) {
                fetchPost(id).then(post => {
                    this.post = post;
                    this.$refs['articleEditor'].innerHtml(post.article);
                }).catch();
            },
            fetchCategories() {
                fetchCategories()
                    .then(response => this.categories = response)
                    .catch()
            },
            onAuthorSelected(author) {
                this.post.author = author;
            },
            clearForm() {
                this.previewImage = null;
                this.post.previewImage = null;
                this.$refs['post-image-uploader'].reset();
                this.post.category = null;
                this.post.title = null;
                this.post.annotation = null;
                this.post.article = null;
                this.post.author = {
                    name: null
                };
                this.post.reference = null;
                this.post.ref_name = null;
                this.$refs['articleEditor'].innerHtml('');
                this.$store.commit('RESET_HTML_ERRORS');
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
