<template>
    <div class="pb-5 mb-5 w-100">
        <main class="container-fluid pt-5 article" v-if="post">
            <b-row>
                <img class="preview-image" :src="previewImageSrc" alt="">
            </b-row>
            <b-row style="margin-top:3rem">
                <b-container fluid="md">
                    <article class="text-light-grey">
                        <section>
                            <div class="mb-4">
                                <h1 class="typography-title-emphasized text-white mb-3" style="font-size:38px">
                                    {{post.title}}</h1>
                                <div class="mb-3">
                                    <span class="typography-title text-violet">Автор: {{post.author.name}}</span>
                                </div>
                                <h2 class="text-muted text-justify">{{post.annotation}}</h2>
                                <network-share
                                    :url="pageUrl"
                                    :title="title"
                                    :description="description"
                                    quote="Echo.tj - Музыкальное наследие Таджикистана"
                                    :media="previewImageSrc"
                                    :hash-tags="hashTags">
                                </network-share>
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
                </b-container>
            </b-row>
        </main>
    </div>
</template>

<script>
    import {fetchPost} from "../../../api/blogApi";
    import {getBlogImage} from "../../../api/mediaApi";
    import MetaTagsMixin from "../../admin/mixins/MetaTagsMixin";
    import NetworkShare from "../../common/inputs/NetworkShare";

    export default {
        name: "PostReader",
        mounted() {
            this.fetchPost();
        },
        mixins: [MetaTagsMixin],
        components: {NetworkShare},
        data() {
            return {
                post: null,
                title: 'Статьи о таджикской музыке, про музыку и около музыки',
                description: 'Новости, статьи, заметки и просто мысли о таджикской музыке и культуре. Личный блог Далера Назарова на "Эхо Таджикистана"'
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
            },
            pageUrl() {
                return window.location.href;
            },
            hashTags() {
                return this.post.author?.name.replace(' ', '');
            }
        },
        watch: {
            post() {
                this.title = this.post.title + ' - автор ' + this.post.author.name;
                this.description = this.post.annotation;
                this.updateTitle();
                this.updateDescription();
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
        max-height: 350px !important;
        object-fit: contain;
        vertical-align: middle;
    }

    .article {
        font-size: 1.1rem;
    }
</style>
