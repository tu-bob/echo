<template>
    <div class="card bg-transparent text-light-grey">
        <b-img class="object-fit-contain w-100 card-img-top pb-4" rounded :src="previewImageSrc" alt=""></b-img>
        <h3>{{post.title}}</h3>
        <p>{{post.annotation}}</p>
        <p>Oct 6th, 2017 by Jon Snow</p>
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
        computed: {
            previewImageSrc() {
                return getBlogImage(this.post.previewImage.id)
            }
        }
    }
</script>

<style scoped>

</style>
