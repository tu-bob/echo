<script>
    import Blog from "../components/blog/Blog";
    import PostsPage from "../components/blog/post/PostsPage";
    import PostEditor from "../components/blog/post/PostEditor";
    import VueRouter from 'vue-router'
    import SongEditor from "../components/media/music/SongEditor";
    import Media from "../components/media/Media";

    const routes = [{
            path: '/blog', component: Blog,
            children: [
                {
                    path: 'posts',
                    component: PostsPage
                },
                {
                    path: 'posts/edit',
                    component: PostEditor
                }
            ]
        },
            {
                path: '/media', component: Media,
                children: [{
                    path:'song',
                    component: SongEditor
                }]
            }]
    ;

    const router = new VueRouter({
        history: true,
        mode: 'history',
        routes,
    });

    export default router
</script>
