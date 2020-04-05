<template>
    <div class="h-overlay-container cursor-pointer" @click="onClicked">
        <div class="video-card">
            <b-img :src="previewImageUrl"
                   class="w-100 object-fit-cover"
                   rounded
                   :blank="showBlank"
                   blankColor="#a892f8cf"
                   style="height:218px"></b-img>
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
    import {getCoverImage, increaseMediaCount} from "../../../api/mediaApi";

    export default {
        name: "VideoCard",
        props: {
            video: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                showBlank: false
            }
        },
        methods: {
            onClicked() {
                this.$emit('play', this.video);
                increaseMediaCount(this.video.id, 'video', 'view');
            }
        },
        computed: {
            previewImageUrl() {
                if (this.video.preview_image_id) {
                    return getCoverImage(this.video.preview_image_id);
                } else {
                    this.showBlank = true;
                }
            }
        }
    }
</script>

<style scoped>
    .h-overlay-container:hover .text-secondary {
        color: white !important;
        text-align: center;
        z-index: 20;
        position: relative;
    }
</style>
