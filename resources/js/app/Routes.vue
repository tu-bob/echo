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
    import SongsTable from "../components/media/music/SongsTable";
    import AlbumEditor from "../components/media/album/AlbumEditor";
    import AlbumsTable from "../components/media/album/AlbumsTable";

    const routes = [
            {
                path: '/login', component: Login
            },
            {
                path: '/register', component: Register
            }
            ,
            {
                path: '/blog', component:
                Blog,
                children:
                    [
                        {
                            path: 'posts',
                            component: PostsPage
                        },
                        {
                            path: 'posts/edit',
                            component: PostEditor
                        }
                    ]
            }
            ,
            {
                path: '/media', component:
                Media,
                children:
                    [
                        {
                            path: 'songs',
                            component: SongsTable
                        },
                        {
                            path: 'song/:id?',
                            component: SongEditor
                        },
                        {
                            path: 'artist/:id?',
                            component: ArtistEditor
                        },
                        {
                            path: 'albums',
                            component: AlbumsTable
                        },
                        {
                            path: 'album/:id?',
                            component: AlbumEditor
                        }
                    ]
            }
        ]
    ;

    const router = new VueRouter({
        history: true,
        mode: 'history',
        base: '/app/',
        routes,
    });

    export default router
</script>
