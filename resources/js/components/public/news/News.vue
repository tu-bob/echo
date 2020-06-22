<template>
    <div class="container">
        <div class="row page-header">
            <h1>Блог</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <posts-masonry-view></posts-masonry-view>
            </div>
        </div>
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
