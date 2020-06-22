<template>
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1 class="col-12">Жанры</h1>
                <router-link class="col-12" :to="{name:'music-list'}">перейти к песням</router-link>
            </div>
        </div>
        <div class="row">
            <router-link :to="{name:'music-list'}"
                         class="genre-pill">
                <h5>Любые жанры</h5></router-link>
            <router-link :to="{name:'music-list', query:{genres: genre.id}}"
                         class="genre-pill"
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
