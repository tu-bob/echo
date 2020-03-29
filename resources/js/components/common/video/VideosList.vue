<template>
    <div class="row">
        <div class="col-md-4" v-for="video in videos" :key="video.id">
            <video-card :video="video"></video-card>
        </div>
    </div>
</template>

<script>
    import {fetchVideos, getCoverImage} from "../../../api/mediaApi";
    import VideoCard from "./VideoCard";

    export default {
        name: "VideosList",
        components: {VideoCard},
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

        }
    }
</script>

<style scoped>

</style>
