export default [
    {
        name: 'admin',
        path: '/admin',
        component: () => import('../AdminApp'),
        children: [
            {
                name: 'a.home',
                path: 'home',
                component: () => import('../pages/HomePage')
            },
            {
                name: 'a.blog',
                path: 'blogs',
                component: () => import('../pages/blog/BlogTabLayout'),
                children: [
                    {
                        name: 'a.blog.management',
                        path: 'manage',
                        props: true,
                        component: () => import('../pages/blog/BlogManagementPage')
                    },
                    {
                        name: 'a.blog.editor',
                        path: 'editor/:id?',
                        props: true,
                        component: () => import('../pages/blog/BlogEditor')
                    },
                ]
            },
            {
                name: 'a.artist',
                path: 'artists',
                component: () => import('../pages/artist/ArtistsTabLayout'),
                children: [
                    {
                        name: 'a.artists.management',
                        path: 'manage',
                        props: true,
                        component: () => import('../pages/artist/ArtistManagementPage')
                    },
                    {
                        name: 'a.artist.editor',
                        path: 'editor/:id?',
                        props: true,
                        component: () => import('../pages/artist/ArtistEditor')
                    },
                ]
            },
            {
                name: 'a.song',
                path: 'songs',
                component: () => import('../pages/song/SongTabLayout'),
                children: [
                    {
                        name: 'a.song.management',
                        path: 'manage',
                        component: () => import('../pages/song/SongManagementPage')
                    },
                    {
                        name: 'a.song.editor',
                        path: 'editor/:id?',
                        component: () => import('../pages/song/SongEditor')
                    },
                ]
            },
            {
                name: 'a.album',
                path: 'album',
                component: () => import('../pages/album/AlbumsTabLayout'),
                children: [
                    {
                        name: 'a.album.management',
                        path: 'manage',
                        component: () => import('../pages/album/AlbumManagementPage')
                    },
                    {
                        name: 'a.album.editor',
                        path: 'editor/:id?',
                        component: () => import('../pages/album/AlbumEditor')
                    },
                ]
            },
            {
                name: 'a.video',
                path: 'video',
                component: () => import('../pages/video/VideoManagementPage')
            }
            // {
            //     path: 'blog',
            //     component: () => import('../../components/admin/blog/BlogAdminView'),
            //     meta: {requiresAuth: true},
            //     children:
            //         [
            //             {
            //                 name: 'posts-table',
            //                 path: 'posts',
            //                 component: () => import('../../components/admin/blog/post/PostsTable')
            //             },
            //             {
            //                 name: 'post-editor',
            //                 path: 'post/:id?',
            //                 component: () => import('../../components/admin/blog/post/PostEditor')
            //             }
            //         ]
            // },
            // {
            //     path: 'media',
            //     component: () => import('../../components/admin/media/MediaAdminView'),
            //     meta: {requiresAuth: true},
            //     children:
            //         [
            //             {
            //                 name: 'songs-table',
            //                 path: 'songs',
            //                 component: () => import('../../components/admin/media/music/SongsTable')
            //             },
            //             {
            //                 name: 'song-editor',
            //                 path: 'song/:id?',
            //                 component: () => import('../../components/admin/media/music/SongEditor')
            //             },
            //             {
            //                 name: 'artists-table',
            //                 path: 'artists',
            //                 component: () => import('../../components/admin/media/artist/ArtistsTable')
            //             },
            //             {
            //                 name: 'artist-editor',
            //                 path: 'artist/:id?',
            //                 props: true,
            //                 component: () => import('../../components/admin/media/artist/ArtistEditor')
            //             },
            //             {
            //                 name: 'albums-table',
            //                 path: 'albums',
            //                 component: () => import('../../components/admin/media/album/AlbumsTable')
            //             },
            //             {
            //                 name: 'album-editor',
            //                 path: 'album/:id?',
            //                 component: () => import('../../components/admin/media/album/AlbumEditor')
            //             }
            //         ]
            // }
        ]
    }
]
