<script>
    import Blog from "../components/blog/Blog";
    import PostsPage from "../components/blog/post/PostsPage";
    import PostEditor from "../components/blog/post/PostEditor";
    import VueRouter from 'vue-router'
    import SongEditor from "../components/media/music/SongEditor";
    import Media from "../components/media/Media";
    import ArtistEditor from "../components/media/artist/ArtistEditor";
    import Login from "../components/auth/Login";
    import Register from "../components/auth/Register";

    const routes = [
        {
            path: '/login', component: Login,
            path: '/register', component: Register,
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
            children: [
                {
                    path: 'song',
                    component: SongEditor
                },
                {
                    path: 'artist',
                    component: ArtistEditor
                },
            ]
        }]
    ;

    const router = new VueRouter({
        history: true,
        mode: 'history',
        routes,
    });

    export default router
</script>
