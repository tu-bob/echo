<template>
    <div class="container">
        <videos-list></videos-list>
    </div>

</template>

<script>
    import VideosList from "../../common/video/VideosList";

    export default {
        name: "ClipsView",
        components: {VideosList}
    }
</script>

<style scoped>

</style>
