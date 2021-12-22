export default [
    {
        name:'admin',
        path: '/admin',
        component:()=>import('../../admin_app/AdminApp'),
        children: [
            {
                path: 'blog',
                component: () => import('../../components/admin/blog/BlogAdminView'),
                meta: {requiresAuth: true},
                children:
                    [
                        {
                            name: 'posts-table',
                            path: 'posts',
                            component: () => import('../../components/admin/blog/post/PostsTable')
                        },
                        {
                            name: 'post-editor',
                            path: 'post/:id?',
                            component: () => import('../../components/admin/blog/post/PostEditor')
                        }
                    ]
            },
            {
                path: 'media',
                component: () => import('../../components/admin/media/MediaAdminView'),
                meta: {requiresAuth: true},
                children:
                    [
                        {
                            name: 'songs-table',
                            path: 'songs',
                            component: () => import('../../components/admin/media/music/SongsTable')
                        },
                        {
                            name: 'song-editor',
                            path: 'song/:id?',
                            component: () => import('../../components/admin/media/music/SongEditor')
                        },
                        {
                            name: 'artists-table',
                            path: 'artists',
                            component: () => import('../../components/admin/media/artist/ArtistsTable')
                        },
                        {
                            name: 'artist-editor',
                            path: 'artist/:id?',
                            props: true,
                            component: () => import('../../components/admin/media/artist/ArtistEditor')
                        },
                        {
                            name: 'albums-table',
                            path: 'albums',
                            component: () => import('../../components/admin/media/album/AlbumsTable')
                        },
                        {
                            name: 'album-editor',
                            path: 'album/:id?',
                            component: () => import('../../components/admin/media/album/AlbumEditor')
                        }
                    ]
            }
        ]
    }
]
