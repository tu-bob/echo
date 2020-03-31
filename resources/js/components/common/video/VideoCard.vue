<template>
    <div class="h-overlay-container cursor-pointer" @click="onClicked">
        <div class="video-card">
            <b-img :src="previewImageUrl" class="w-100 object-fit-contain"></b-img>
            <div class="pt-3 text-secondary">
                {{video.title}}
            </div>
        </div>
        <div class="bg-violet-gradient h-overlay d-flex align-items-center">
            <div class="btn btn-light mx-auto">
                <img class="icon-btn-xl" src="/icons/svg/play-btn-light.svg">
            </div>
        </div>
    </div>
</template>

<script>
    import {getCoverImage} from "../../../api/mediaApi";

    export default {
        name: "VideoCard",
        props: {
            video: {
                type: Object,
                required: true
            }
        },
        methods: {
            onClicked() {
                this.$emit('play', this.video);
            }
        },
        computed: {
            previewImageUrl() {
                if (this.video.preview_image_id) {
                    return getCoverImage(this.video.preview_image_id);
                } else {

                }
            }
        }
    }
</script>

<style scoped>
    .h-overlay-container:hover .text-secondary{
        color:white!important;
        text-align: center;
        z-index: 20;
        position: relative;
    }
</style>
