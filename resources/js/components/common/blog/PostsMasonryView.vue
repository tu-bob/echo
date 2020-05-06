<template>
    <div class="card-columns">
        <post-preview v-for="post in posts" :post="post" :key="post.id"></post-preview>
    </div>
</template>

<script>
    import PostPreview from "../../common/blog/PostPreview";
    import {fetchPosts} from "../../../api/blogApi";
    import AxiosCancellationMixin from "../../admin/mixins/AxiosCancellationMixin";

    export default {
        name: "PostsMasonryView",
        mixins:[AxiosCancellationMixin],
        mounted() {
            this.fetchPosts()
        },
        data() {
            return {
                paginator: null,
                posts: []
            }
        },
        methods: {
            fetchPosts(page = 1) {
                fetchPosts({order: 'latest', page: page, paginate: 15},
                    {cancelToken: this.getCancellationToken()}
                )
                    .then(response => {
                        this.paginator = response;
                        this.posts.push(...response.data)
                    })
                    .catch()
            }
        },
        components: {PostPreview}
    }
</script>

<style scoped>

</style>
