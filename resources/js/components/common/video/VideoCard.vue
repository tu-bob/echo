<template>
    <div class="playable-card" @click="onClicked">
        <div class="playable-cover-wrapper">
            <b-img :src="previewImageUrl"
                   class="playable-cover"
                   :blank="showBlank"
                   blankColor="#a892f8cf"
                   style="height:218px"></b-img>
        </div>
        <div class="playable-info">
            <div class="pt-3 text-secondary">
                {{video.title}}
            </div>
        </div>
    </div>
</template>

<script>
    import {getCoverImage, increaseMediaCount} from "../../../api/mediaApi";
    import {getYoutubeEmbedPreview} from "../../../util/stringHelper";

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
            },
        },
        computed: {
            previewImageUrl() {
                let youtubePreviewUrl = getYoutubeEmbedPreview(this.video.src);
                if (youtubePreviewUrl)
                    return youtubePreviewUrl;
                if (this.video.preview_image_id) {
                    return getCoverImage(this.video.preview_image_id);
                } else {
                    this.showBlank = true;
                }
            }
        }
    }
</script>
