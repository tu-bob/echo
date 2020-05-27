<template>
    <div>
        <posts-masonry-view></posts-masonry-view>
    </div>

</template>

<script>
    import PostsMasonryView from "../../common/blog/PostsMasonryView";
    import MetaTagsMixin from "../../admin/mixins/MetaTagsMixin";

    export default {
        name: "News",
        data() {
            return {
                title: 'Echo.tj - Музыкальные новости Таджикистана',
                description: 'Новости, статьи, обзоры о таджикской музыке. Узнавайте первыми о релизах альбомов и песен. ' +
                    'Информация о концертах и много другом на Echo.tj'
            }
        },
        mixins: [MetaTagsMixin],
        components: {PostsMasonryView}
    }
</script>

<style scoped>

</style>
