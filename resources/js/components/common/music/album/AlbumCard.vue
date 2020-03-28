<template>
    <div class="text-white">
        <b-img class="album-cover" rounded :src="coverUrl" alt=""></b-img>

        <h5 class="mt-3 mb-0">{{album.title}}</h5>
        <span class="text-muted">Далер Назаров</span>
    </div>
</template>

<script>
    import {getAlbumCoverUrl} from "../../../../api/mediaApi";

    export default {
        name: "AlbumCard",
        props: {
            album: {
                type: Object,
                required: true
            }
        },
        computed: {
            coverUrl() {
                return getAlbumCoverUrl(this.album.id)
            }
        }
    }
</script>

<style scoped>
    .album-cover {
        object-fit: cover;
        width: 100% !important;
        height: 218px;
    }
</style>
