<template>
    <div class="card bg-transparent text-light-grey cursor-pointer" @click="navigate">
        <b-img class="object-fit-contain w-100 card-img-top pb-4" rounded :src="previewImageSrc" alt=""></b-img>
        <h3>{{post.title}}</h3>
        <p>{{post.annotation}}</p>
        <p>{{post.created_at |luxon:locale('short')}} <span v-if="post.author">{{post.author.name}}</span></p>
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
                this.$router.push({name: 'post-reader', params: {id: this.post.id}})
            }
        },
        computed: {
            previewImageSrc() {
                return getBlogImage(this.post.previewImage.id)
            }
        }
    }
</script>

<style scoped>

</style>
