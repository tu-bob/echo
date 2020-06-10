<template>
    <div class="pb-5 mb-5 w-100">
        <main class="container-fluid pt-5 article" v-if="post">

            <b-row>
                <img class="preview-image" :src="previewImageSrc" alt="">
            </b-row>

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
            slug: {
                required: true,
                type: String
            }
        },
        methods: {
            fetchPost() {
                fetchPost(this.slug)
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
        height:400px !important;
        object-fit: contain;
        vertical-align: middle;
    }

    .article {
        font-size: 1.1rem;
    }
</style>
