<template>
    <div class="row">
        <album-card class="col-12 col-md-6 col-lg-4 col-xl-3 mb-5"
                    v-for="album in albums" :key="album.id"
                    :album="album"></album-card>

        <pagination v-if="pagination"
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

    export default {
        name: "AlbumsList",
        mounted() {
            this.fetchAlbums()
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
                fetchAlbums({order: 'latest', songs: 1, page: page, paginate: 15})
                    .then(response => {
                        this.pagination = response;
                        this.albums.push(...response.data)
                    })
                    .catch()
                    .then(_ => {
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
        components: {AlbumCard}
    }
</script>

<style scoped>

</style>
