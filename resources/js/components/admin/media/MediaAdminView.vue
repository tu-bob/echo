<template>
    <div class="bg-laravel container mb-5 p-0">
        <router-view></router-view>
    </div>
</template>

<script>
    import LaravelBackground from "../../common/mixins/LaravelBackground";

    export default {
        name: "AdminMediaView",
        mixins: [LaravelBackground]
    }
</script>

<style scoped>

</style>
