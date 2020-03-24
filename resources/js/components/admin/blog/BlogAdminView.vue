<template>
    <div class="bg-laravel p-0 container">
        <router-view></router-view>
    </div>

</template>

<script>
    import {removeLaravelBackground, setLaravelBackground} from "../../../main";

    export default {
        name: "BlogAdminView",
        created() {
            setLaravelBackground()
        },
        destroyed() {
            removeLaravelBackground()
        }
    }
</script>

<style scoped>

</style>
