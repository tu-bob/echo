<script>
import VueRouter from 'vue-router'
import {store} from '../store';
import adminRoutes from '../admin_app/routes/admin-routes'

const routes = [
        {
            // name: 'public',
            path: '/app',
            component: () => import('./PublicApp'),
            children: [
                {
                    name: 'login',
                    props: (route) => ({redirectUrl: route.query.redirectUrl}),
                    path: 'login', component: () => import('../components/auth/Login')
                },
                // {
                //     name: 'register',
                //     path: '/register', component: () => import('../components/auth/Register')
                // },
                {
                    name: 'search',
                    path: 'search/:query?',
                    component: () => import('../components/public/search/SearchOverview'),
                    props: true
                },
                {
                    name: 'home',
                    path: '',
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
                            redirect: {name: 'music-list'},
                            component: () => import('../components/public/music/MusicViewer'),
                            children: [
                                {
                                    name: 'music-list',
                                    path: '',
                                    props: (route) => ({genres: route.query.genres}),
                                    component: () => import('../components/public/music/Music')
                                },
                                {
                                    name: 'genres',
                                    path: 'genres',
                                    component: () => import('../components/public/music/Genres')
                                }
                            ]
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
                        },
                        {
                            name: 'about',
                            path: 'about',
                            component: () => import('../components/public/home/AboutUs')
                        },
                        {
                            name: 'artists',
                            path: 'artists',
                            component: () => import('../components/public/artist/ArtistsView')
                        }
                    ]
                },
                {
                    name: 'album-view',
                    path: 'albums/:id',
                    props: true,
                    component: () => import('../components/public/album/AlbumView')
                },
                {
                    name: 'song-view',
                    path: 'songs/:id',
                    props: true,
                    component: () => import('../components/public/music/SongView')
                },
                {
                    name: 'artist-view',
                    path: 'artists/:id',
                    props: true,
                    component: () => import('../components/public/artist/ArtistView')
                },
                {
                    name: 'post-reader',
                    path: 'blog/post/:slug',
                    props: true,
                    component: () => import('../components/public/blog/PostReader'),
                },
                {
                    name:'music-charts',
                    path:'charts/music',
                    props:true,
                    component: () => import('../components/public/charts/MusicalChartsPage')
                },
                {
                    name:'s.khalil',
                    path:'ssh/skhalil_production',
                    props:true,
                    component: () => import('../components/public/partners/SKhalil')
                }
            ]
        },

        ...adminRoutes
    ]
;

const router = new VueRouter({
    history: true,
    mode: 'history',
    base: '/',
    routes
});

router.beforeEach(async (to, from, next) => {
        store.commit('SHOW_MAIN_OVERLAY');
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

router.afterEach((to, from) => {
    store.commit('PUSH_ROUTE_TO_HISTORY', from);
    store.commit('HIDE_MAIN_OVERLAY');
});
export default router
</script>
