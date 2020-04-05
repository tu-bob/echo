<template>
    <div>
        <b-input-group prepend="Поиск" class="mt-3">
            <input @keydown.enter="search"
                   type="text"
                   class="form-control bg-dark text-white border-secondary"
                   v-model="query">
            <b-input-group-append>
                <b-button variant="secondary" @click="search">Найти</b-button>
            </b-input-group-append>
        </b-input-group>

    </div>
</template>

<script>
    import {search} from "../../../api/mediaApi";

    export default {
        name: "SearchOverview",
        data() {
            return {
                query: '',
                songs: [],
                videos: [],
                albums: []
            }
        },
        methods: {
            search() {
                search(this.query)
                    .then(response => {
                        this.songs = response.songs;
                        this.videos = response.videos;
                        this.albums = response.albums;
                    })
                    .catch()
            }
        }
    }
</script>

<style scoped>

</style>
