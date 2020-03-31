<template>
    <div class="row">
        <album-card class="col-12 col-md-6 col-lg-4 col-xl-3 mb-5"
                    v-for="album in albums" :key="album.id"
                    :album="album"></album-card>
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
                paginator: null,
                albums: []
            }
        },
        methods: {
            fetchAlbums(page = 1) {
                fetchAlbums({order: 'latest', page: page, paginate: 15})
                    .then(response => {
                        this.paginator = response;
                        this.albums.push(...response.data)
                    })
                    .catch()
            }
        },
        components: {AlbumCard}
    }
</script>

<style scoped>

</style>
