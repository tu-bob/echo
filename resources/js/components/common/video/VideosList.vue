<template>
    <div>
        <div class="row">
            <div class="col-md-4 col-lg-3 mb-5" v-for="video in videos" :key="video.id">
                <video-card :video="video" @play="showVideoModal"></video-card>
            </div>
        </div>

        <div v-if="selectedVideo">
            <b-modal id="modal-video-player"
                     class="bg-transparent"
                     centered
                     :title="selectedVideo.title"
                     header-bg-variant="dark"
                     header-text-variant="light"
                     body-bg-variant="dark"
                     body-text-variant="light"
                     hide-footer
                     size="xl"
                     content-class="border-0"
                     header-class="border-0"
                     ok-only>
                <b-embed
                    type="iframe"
                    aspect="16by9"
                    :src="selectedVideo.src"
                    allowfullscreen
                ></b-embed>
            </b-modal>
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
                videos: [],
                selectedVideo: null
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
            showVideoModal(video) {
                this.selectedVideo = video;
                this.$nextTick(
                    () => this.$bvModal.show('modal-video-player')
                )

            }
        }
    }
</script>

<style scoped>

</style>
