<template>
    <div>
        <posts-masonry-view></posts-masonry-view>
    </div>

</template>

<script>
    import PostsMasonryView from "../../common/blog/PostsMasonryView";
    import TitleMixin from "../../admin/mixins/TitleMixin";

    export default {
        name: "News",
        data() {
            return {
                title: 'Echo.tj - Музыкальные новости Таджикистана'
            }
        },
        mixins: [TitleMixin],
        components: {PostsMasonryView}
    }
</script>

<style scoped>

</style>
