<template>
    <div>
        <div class="d-flex">
            <router-link class="ml-auto mb-5 mr-2" :to="{name:'music-list'}">Вернуться к песням</router-link>
        </div>
        <div class="row">
            <router-link :to="{name:'music-list'}"
                         class="col-md-4 col-lg-3 col-xl-2 mb-3 btn-text-white cursor-pointer">
                <h5>Любые жанры</h5></router-link>
            <router-link :to="{name:'music-list', query:{genres: genre.id}}"
                         class="col-md-4 col-lg-3 col-xl-2 mb-3 btn-text-white cursor-pointer"
                         v-for="genre in genres" :key="genre.id">
                <h5>{{genre.local_name}}</h5>
            </router-link>
        </div>
    </div>
</template>

<script>
    import {fetchGenresList} from "../../../api/mediaApi";

    export default {
        name: "Genres",
        mounted() {
            this.fetchGenres()
        },
        data() {
            return {
                genres: []
            }
        },
        methods: {
            fetchGenres() {
                fetchGenresList()
                    .then(genres => this.genres = genres)
                    .catch()
            }
        }
    }
</script>

<style scoped>

</style>
