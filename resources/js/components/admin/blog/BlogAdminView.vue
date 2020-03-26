<template>
    <div class="bg-laravel p-0 container">
        <router-view></router-view>
    </div>

</template>

<script>
    import LaravelBackground from "../../common/mixins/LaravelBackground";

    export default {
        name: "BlogAdminView",
        mixins: [LaravelBackground]
    }
</script>

<style scoped>

</style>
