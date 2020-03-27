<template>
    <div class="pb-5 mb-5">
        <main class="container pt-5 article">
            <b-img class="preview-image pb-4" rounded :src="previewImageSrc" alt=""></b-img>
            <article class="text-light-grey">
                <section>
                    <div class="mb-4">
                        <h1 class="text-light mb-3">{{post.title}}</h1>
                        <div class="mb-3">
                            <span>Автор: {{post.author.name}}</span>
                        </div>
                        <h2 class="text-muted text-justify">{{post.annotation}}</h2>
                    </div>

                    <div class="text-justify article-body" v-html="post.article"></div>
                </section>
            </article>
            <div v-if="post.reference" class="pt-4">
                <a :href="post.reference">
                    <span v-if="post.ref_name">{{post.ref_name}}</span>
                    <span v-else>{{post.reference}}</span>
                </a>
            </div>
        </main>
    </div>
</template>

<script>
    import {fetchPost} from "../../../api/blogApi";
    import {getBlogImage} from "../../../api/mediaApi";

    export default {
        name: "PostReader",
        mounted() {
            this.fetchPost();
        },
        data() {
            return {
                post: null
            }
        },
        props: {
            id: {
                required: true,
                type: String
            }
        },
        methods: {
            fetchPost() {
                fetchPost(this.id)
                    .then(response => this.post = response)
                    .catch()
            }
        },
        computed: {
            previewImageSrc() {
                if (this.post)
                    return getBlogImage(this.post.previewImage.id)
            }
        }
    }
</script>

<style scoped>
    h2 {
        font-size: 1.3rem;
    }

    .preview-image {
        width: 100% !important;
        max-height: 68vh;
        object-fit: contain;
        vertical-align: middle;
    }

    .article {
        font-size: 1.1rem;
    }
</style>
