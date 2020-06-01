<template>
    <div style="padding-bottom: 10rem">
        <div class="row">
            <album-card class="col-12  col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-5"
                        v-for="album in albums" :key="album.id"
                        :album="album"></album-card>
        </div>
        <pagination v-if="pagination && !noFetch"
                    ref="albums-list-pagination"
                    flow
                    :pagination="pagination"
                    class="mt-5"
                    @pageChanged="fetchAlbums"
                    v-observe-visibility="paginationIntersObj">
        </pagination>
    </div>
</template>

<script>
    import AlbumCard from "./AlbumCard";
    import {fetchAlbums} from "../../../../api/mediaApi";
    import Pagination from "../../inputs/Pagination";
    import AxiosCancellationMixin from "../../../admin/mixins/AxiosCancellationMixin";

    export default {
        name: "AlbumsList",
        mixins: [AxiosCancellationMixin],
        mounted() {
            if (this.providedAlbums)
                this.albums = this.providedAlbums;
            else if (!this.noFetch)
                this.fetchAlbums()
        },
        props: {
            providedAlbums: null,
            noFetch: {
                type: Boolean
            }
        },
        data() {
            return {
                pagination: null,
                albums: [],
                isFetchingAlbums: false,
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
            fetchAlbums(page = 1) {
                this.isFetchingAlbums = true;
                fetchAlbums({order: 'latest', songs: 1, page: page, paginate: 15},
                    {cancelToken: this.getCancellationToken()}
                )
                    .then(response => {
                        this.pagination = response;
                        this.albums.push(...response.data)
                    })
                    .finally(_ => {
                        this.$refs['albums-list-pagination'].loaded();
                        this.isFetchingAlbums = false;
                    })
            },
            paginationVisibilityChanged(isVisible, entry) {
                let btn = entry.target.querySelector('button');
                if (isVisible && !this.isFetchingAlbums && btn)
                    btn.click()
            }
        },
        watch: {
            providedAlbums() {
                this.albums = this.providedAlbums;
            }
        },
        components: {AlbumCard, Pagination}
    }
</script>

<style scoped>

</style>
