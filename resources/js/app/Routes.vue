<script>
    import VueRouter from 'vue-router'
    import {store} from '../store';

    const routes = [
            {
                name: 'login',
                props: (route) => ({redirectUrl: route.query.redirectUrl}),
                path: '/login', component: () => import('../components/auth/Login')
            },
            // {
            //     name: 'register',
            //     path: '/register', component: () => import('../components/auth/Register')
            // },
            {
                name: 'search',
                path: '/search', component: () => import('../components/public/search/SearchOverview')
            },
            {
                name: 'home',
                path: '/',
                redirect: {name: 'overview'},
                component: () => import('../components/public/home/HomeViewer'),
                children: [
                    {
                        name: 'overview',
                        path: 'overview',
                        component: () => import('../components/public/home/overview/Overview')
                    },
                    {
                        name: 'blog',
                        path: 'blog',
                        component: () => import('../components/public/news/News')
                    },
                    {
                        name: 'music',
                        path: 'music',
                        component: () => import('../components/public/music/MusicView')
                    },
                    {
                        name: 'albums',
                        path: 'albums',
                        component: () => import('../components/public/album/AlbumsView')
                    },
                    {
                        name: 'clips',
                        path: 'clips',
                        component: () => import('../components/public/video/ClipsView')
                    }
                ]
            },
            {
                name: 'post-reader',
                path: '/blog/post/:slug',
                props: true,
                component: () => import('../components/public/blog/PostReader'),
            },
            {
                path: '/admin/blog',
                component: () => import('../components/admin/blog/BlogAdminView'),
                meta: {requiresAuth: true},
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
                component: () => import('../components/admin/media/MediaAdminView'),
                meta: {requiresAuth: true},
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
        routes
    });

    router.beforeEach(async (to, from, next) => {
            if (to.matched.some(record => record.meta.requiresAuth)) {
                if (store.getters.AUTHENTICATED) {
                    next();
                } else {
                    try {
                        await store.dispatch('FETCH_USER');
                        next();
                    } catch (e) {
                        next();
                    }
                }
            } else
                next();
        }
    );
    export default router
</script>
