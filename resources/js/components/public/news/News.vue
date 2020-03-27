<template>
    <div>
        <posts-masonry-view></posts-masonry-view>
    </div>

</template>

<script>
    import PostsMasonryView from "../../common/blog/PostsMasonryView";

    export default {
        name: "News",
        components: {PostsMasonryView}
    }
</script>

<style scoped>

</style>
