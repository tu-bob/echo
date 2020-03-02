<template>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse">
                <div class="navbar-nav">
                    <router-link to="/blog/posts" class="nav-item nav-link">Home</router-link>
                    <router-link to="/blog/posts/edit" class="nav-item nav-link">Blog</router-link>
                    <router-link to="/media/song" class="nav-item nav-link">Media</router-link>
                </div>
            </div>
        </nav>
        <br/>
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        name: "App",
        mounted(){
        },
        data() {
            return {

            }
        },
        methods: {

        }
    }
</script>

<style scoped>

</style>
