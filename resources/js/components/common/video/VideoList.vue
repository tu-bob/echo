<template>
    <div class="row">
        <div v-for="video in videos" :key="video.id">
            <b-img :src="getPreviewUrl(video)" class="w-100 object-fit-contain"></b-img>
            <div>
                {{video.title}}
            </div>
        </div>
    </div>
</template>

<script>
    import {fetchVideos, getCoverImage} from "../../../api/mediaApi";

    export default {
        name: "VideoList",
        mounted() {
            this.fetchVideos();
        },
        data() {
            return {
                paginator: null,
                videos: []
            }
        },
        methods: {
            fetchVideos() {
                fetchVideos()
                    .then(response => {
                        this.paginator = response;
                        this.videos.push(...response.data);
                    })
                    .catch();
            },
            getPreviewUrl(video) {
                console.log(video)
                if (video.preview_image_id) {
                    return getCoverImage(video.preview_image_id);
                } else {

                }
            }
        }
    }
</script>

<style scoped>

</style>
