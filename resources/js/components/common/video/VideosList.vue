<template>
    <div>
        <div class="row">
            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-5" v-for="video in videos" :key="video.id">
                <video-card :video="video" @play="showVideoModal"></video-card>
            </div>

            <pagination v-if="pagination"
                        ref="albums-list-pagination"
                        flow
                        :pagination="pagination"
                        class="mt-5"
                        @pageChanged="fetchVideos"
                        v-observe-visibility="paginationIntersObj">
            </pagination>
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
    import {fetchVideos} from "../../../api/mediaApi";
    import VideoCard from "./VideoCard";
    import Pagination from "../inputs/Pagination";

    export default {
        name: "VideosList",
        components: {VideoCard, Pagination},
        mounted() {
            this.fetchVideos();
        },
        data() {
            return {
                pagination: null,
                videos: [],
                selectedVideo: null,
                isFetchingVideos: false,
                paginationIntersObj: {
                    callback: this.paginationVisibilityChanged,
                    intersection: {
                        threshold: 0.3,
                        rootMargin: '200px',
                        throttle: 100
                    }
                }
            }
        },
        methods: {
            fetchVideos(page = 1) {
                this.isFetchingVideos = true;
                fetchVideos({order: 'latest', page: page, paginate: 15})
                    .then(response => {
                        this.pagination = response;
                        this.videos.push(...response.data);
                    })
                    .catch()
                    .then(_ => {
                        this.isFetchingVideos = false
                    })
            },
            showVideoModal(video) {
                this.selectedVideo = video;
                this.$nextTick(
                    () => this.$bvModal.show('modal-video-player')
                )

            },
            paginationVisibilityChanged(isVisible, entry) {
                let btn = entry.target.querySelector('button');
                if (isVisible && !this.isFetchingVideos && btn)
                    btn.click()
            }
        }
    }
</script>

<style scoped>

</style>
