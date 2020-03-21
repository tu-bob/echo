<script>
    import BlogAdminView from "../components/admin/blog/BlogAdminView";
    import PostEditor from "../components/admin/blog/post/PostEditor";
    import VueRouter from 'vue-router'
    import SongEditor from "../components/admin/media/music/SongEditor";
    import ArtistEditor from "../components/admin/media/artist/ArtistEditor";
    import Login from "../components/auth/Login";
    import Register from "../components/auth/Register";
    import SongsTable from "../components/admin/media/music/SongsTable";
    import AlbumEditor from "../components/admin/media/album/AlbumEditor";
    import AlbumsTable from "../components/admin/media/album/AlbumsTable";
    import ArtistsTable from "../components/admin/media/artist/ArtistsTable";
    import PostsTable from "../components/admin/blog/post/PostsTable";
    import AdminMediaView from "../components/admin/media/AdminMediaView";


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
                path: '/admin/media', component:
                AdminMediaView,
                children:
                    [
                        {
                            name: 'songs-table',
                            path: 'songs',
                            component: SongsTable
                        },
                        {
                            name: 'song-editor',
                            path: 'song/:id?',
                            component: SongEditor
                        },
                        {
                            name: 'artists-table',
                            path: 'artists',
                            component: ArtistsTable
                        },
                        {
                            name: 'artist-editor',
                            path: 'artist/:id?',
                            component: ArtistEditor
                        },
                        {
                            name: 'albums-table',
                            path: 'albums',
                            component: AlbumsTable
                        },
                        {
                            name: 'album-editor',
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
