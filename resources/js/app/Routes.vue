<script>
    import BlogAdminView from "../components/admin/blog/BlogAdminView";
    import PostEditor from "../components/admin/blog/post/PostEditor";
    import VueRouter from 'vue-router'
    import SongEditor from "../components/media/music/SongEditor";
    import Media from "../components/media/Media";
    import ArtistEditor from "../components/media/artist/ArtistEditor";
    import Login from "../components/auth/Login";
    import Register from "../components/auth/Register";
    import SongsTable from "../components/media/music/SongsTable";
    import AlbumEditor from "../components/media/album/AlbumEditor";
    import AlbumsTable from "../components/media/album/AlbumsTable";
    import ArtistsTable from "../components/media/artist/ArtistsTable";
    import PostsTable from "../components/admin/blog/post/PostsTable";

    const routes = [
            {
                path: '/login', component: Login
            },
            {
                path: '/register', component: Register
            }
            ,
            {
                path: '/admin/blog', component:
                BlogAdminView,
                children:
                    [
                        {
                            name: 'posts-table',
                            path: 'posts',
                            component: PostsTable
                        },
                        {
                            name: 'post-editor',
                            path: 'post/:id?',
                            component: PostEditor
                        }
                    ]
            },
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
                            path: 'artists',
                            component: ArtistsTable
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

    router.beforeEach((to, from, next) => {
        console.log(to, from, next);
        next();
    })

    export default router
</script>
