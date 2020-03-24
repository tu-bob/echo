<template>
    <div class="bg-laravel container mb-5 p-0">
        <router-view></router-view>
    </div>
</template>

<script>
    import {removeLaravelBackground, setLaravelBackground} from "../../../main";

    export default {
        name: "AdminMediaView",
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
