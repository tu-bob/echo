<template>
    <div class="card post-preview" @click="navigate">
        <b-img class="object-fit-contain w-100 card-img-top mb-2" rounded :src="previewImageSrc" :alt="'Обложка' + post.title"></b-img>
        <h3 class="post-title">{{post.title}}</h3>
        <p class="post-annotation">{{post.annotation}}</p>
        <p class="post-details">{{post.created_at |luxon:format('dd.MM.yyyy')}} <span v-if="post.author">{{post.author.name}}</span></p>
    </div>
</template>

<script>
    import {getBlogImage} from "../../../api/mediaApi";

    export default {
        name: "PostPreview",
        props: {
            post: {
                type: Object,
                required: true
            }
        },
        methods: {
            navigate() {
                this.$router.push({name: 'post-reader', params: {slug: this.post.slug}})
            }
        },
        computed: {
            previewImageSrc() {
                return getBlogImage(this.post.previewImage.id, {width: 500})
            }
        }
    }
</script>

<style scoped>

</style>
