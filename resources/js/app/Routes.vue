<script>
    import VueRouter from 'vue-router'

    const routes = [
            {
                path: '/login', component: () => import('../components/auth/Login')
            },
            {
                path: '/register', component: () => import('../components/auth/Register')
            }
            ,
            {
                path: '/admin/blog',
                component: () => import('../components/admin/blog/BlogAdminView'),
                children:
                    [
                        {
                            name: 'posts-table',
                            path: 'posts',
                            component: () => import('../components/admin/blog/post/PostsTable')
                        },
                        {
                            name: 'post-editor',
                            path: 'post/:id?',
                            component: () => import('../components/admin/blog/post/PostEditor')
                        }
                    ]
            },
            {
                path: '/admin/media',
                component: () => import('../components/admin/media/AdminMediaView'),
                children:
                    [
                        {
                            name: 'songs-table',
                            path: 'songs',
                            component: () => import('../components/admin/media/music/SongsTable')
                        },
                        {
                            name: 'song-editor',
                            path: 'song/:id?',
                            component: () => import('../components/admin/media/music/SongEditor')
                        },
                        {
                            name: 'artists-table',
                            path: 'artists',
                            component: () => import('../components/admin/media/artist/ArtistsTable')
                        },
                        {
                            name: 'artist-editor',
                            path: 'artist/:id?',
                            component: () => import('../components/admin/media/artist/ArtistEditor')
                        },
                        {
                            name: 'albums-table',
                            path: 'albums',
                            component: () => import('../components/admin/media/album/AlbumsTable')
                        },
                        {
                            name: 'album-editor',
                            path: 'album/:id?',
                            component: () => import('../components/admin/media/album/AlbumEditor')
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
