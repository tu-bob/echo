<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2" v-for="video in videos" :key="video.id">
                <video-card :video="video" @play="showVideoModal"></video-card>
            </div>
        </div>

        <pagination v-if="pagination"
                    ref="videos-list-pagination"
                    flow
                    :pagination="pagination"
                    class="mt-5"
                    @pageChanged="fetchVideos"
                    v-observe-visibility="paginationIntersObj">
        </pagination>

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
                     size="lg"
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
    import AxiosCancellationMixin from "../../admin/mixins/AxiosCancellationMixin";

    export default {
        name: "VideosList",
        components: {VideoCard, Pagination},
        mixins: [AxiosCancellationMixin],
        mounted() {
            if (this.providedVideos)
                this.videos = this.providedVideos;
            else if (!this.noFetch)
                this.fetchVideos();
        },
        props: {
            providedVideos: {
                type: Array
            },
            noFetch: {
                type: Boolean
            }
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
                fetchVideos({order: 'latest', page: page, paginate: 15},
                    {cancelToken: this.getCancellationToken()}
                )
                    .then(response => {
                        this.pagination = response;
                        this.videos.push(...response.data);
                    })
                    .finally(_ => {
                        this.$refs['videos-list-pagination'].loaded();
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
        },
        watch: {
            providedVideos() {
                this.videos = this.providedVideos;
            }
        }
    }
</script>

<style scoped>

</style>
