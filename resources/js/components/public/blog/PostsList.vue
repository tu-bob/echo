<template>
    <div class="row">
        <post-preview class="col-sm-6 col-md-4 col-lg-3 col-xl-2" v-for="post in posts" :post="post" :key="post.id"></post-preview>
    </div>
</template>

<script>
    import PostPreview from "../../common/blog/PostPreview";
    export default {
        name: "PostsList",
        components: {PostPreview},
        mounted() {
            if (this.providedPosts)
                this.posts = this.providedPosts;
        },
        props: {
            providedPosts: {
                type: Array
            },
            noFetch: {
                type: Boolean
            }
        },
        data() {
            return {
                posts: []
            }
        },
        watch: {
            providedPosts() {
                this.posts = this.providedPosts;
            }
        }
    }
</script>

<style scoped>

</style>
