<template>
    <div class="app-wrapper container-fluid">
        <!--        <b-overlay variant="dark" no-wrap :show="isMainOverlayVisible" spinner-variant="light">-->
        <!--        </b-overlay>-->

        <div class="row bg-dark divider-bottom header">
            <b-navbar class="col-12" :type="NAV_TYPE" :variant="NAV_VARIANT">
                <!--side menu toggle button-->
                <button v-b-toggle.side-menu class="hamburger hamburger--spin js-hamburger mr-3"
                        :class="{'is-active': !menuCollapsed}"
                        type="button">
                      <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                      </span>
                </button>

                <b-navbar-brand title="Перейти на главную" :to="{name: 'home'}" class="py-0 d-none d-md-block">
                    <img src="/icons/png/logo-nav.png" alt="echo.tj logo" style="height: 60px">
                </b-navbar-brand>

                <div id="search-input" v-if="$route.name !== 'search'">
                    <input class="form-control-sm"
                           v-model="searchQuery"
                           placeholder="Трек, альбом, артист"
                           type="text"
                           @keydown.enter="navToSearch">
                    <font-awesome-icon class="text-secondary h-text-white"
                                       icon="search"
                                       @click="navToSearch">
                    </font-awesome-icon>
                </div>

                <b-navbar-nav>
                    <template v-if="AUTHENTICATED">
                        <b-nav-item-dropdown text="Блог" left>
                            <b-dropdown-item :to="{name: 'posts-table'}">Посты</b-dropdown-item>
                            <b-dropdown-item :to="{name: 'post-editor'}">Добавить пост</b-dropdown-item>
                        </b-nav-item-dropdown>

                        <b-nav-item-dropdown text="Медиа" left>
                            <b-dropdown-item :to="{name: 'artists-table'}">Исполнители</b-dropdown-item>
                            <b-dropdown-item :to="{name: 'artist-editor'}">Добавить исполнителя</b-dropdown-item>
                            <b-dropdown-divider></b-dropdown-divider>
                            <b-dropdown-item :to="{name: 'songs-table'}">Песни</b-dropdown-item>
                            <b-dropdown-item :to="{name: 'song-editor'}">Добавить песню</b-dropdown-item>
                            <b-dropdown-divider></b-dropdown-divider>
                            <b-dropdown-item :to="{name: 'albums-table'}">Альбомы</b-dropdown-item>
                            <b-dropdown-item :to="{name: 'album-editor'}">Добавить альбом</b-dropdown-item>
                        </b-nav-item-dropdown>
                    </template>
                </b-navbar-nav>

                <ul class="social-icons d-none d-md-block ml-auto">
                    <li class="mr-1">
                        <facebook url="https://www.facebook.com/echotjk" title="Подписывайтесь на нас на фейсбуке"></facebook>
                    </li>
                    <li class="mr-1">
                        <instagram url="https://www.instagram.com/echo.tj/" title="Прямые эфиры, сторисы и многое другое на нашем инстаграм канале"></instagram>
                    </li>
                    <li>
                        <youtube url="https://www.youtube.com/channel/UCmhQHgvauoO6KcCu73l5XDQ" title="Ждите каверы на нашем ютуб канале"></youtube>
                    </li>
                </ul>
            </b-navbar>
            <div class="col-4 pr-4 d-flex align-items-center justify-content-end">
                <template v-if="AUTHENTICATED">
                    <b-avatar class="ml-auto mr-0 mr-md-3" :variant="AVATAR_VARIANT"></b-avatar>
                    <div class="user-name d-none d-md-flex">
                        {{AUTH_USER.name}}
                    </div>
                    <div class="dropdown">
                        <div class="btn btn-text-white"
                             type="button"
                             id="profileMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <font-awesome-icon icon="caret-down"></font-awesome-icon>
                        </div>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileMenu">
                            <a class="dropdown-item" href="#" @click="logout">Выйти</a>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <div id="tMainSpinner" :class="{'d-none':!isMainOverlayVisible}">
            <div class="spinner"></div>
        </div>

        <!--Sidebar menu-->
        <b-sidebar id="side-menu" title="Sidebar" shadow width="240px" no-header>
            <ul class="main-nav">
                <li class="nav-item">
                    <router-link :to="{name:'overview'}" class="nav-link">
                        <div class="nav-link-content">
                            <font-awesome-icon icon="home" class="nav-icon"></font-awesome-icon>
                            <span class="nav-link-text">Главная</span>
                        </div>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{name:'blog'}" class="nav-link">
                        <div class="nav-link-content">
                            <font-awesome-icon icon="newspaper" class="nav-icon"></font-awesome-icon>
                            <span class="nav-link-text">Блог</span>
                        </div>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{name:'music'}" class="nav-link">
                        <div class="nav-link-content">
                            <font-awesome-icon icon="music" class="nav-icon"></font-awesome-icon>
                            <span class="nav-link-text">Песни</span>
                        </div>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{name:'albums'}" class="nav-link">
                        <div class="nav-link-content">
                            <font-awesome-icon icon="compact-disc" class="nav-icon"></font-awesome-icon>
                            <span class="nav-link-text">Альбомы</span>
                        </div>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{name:'artists'}" class="nav-link">
                        <div class="nav-link-content">
                            <font-awesome-icon icon="user" class="nav-icon"></font-awesome-icon>
                            <span class="nav-link-text">Исполнители</span>
                        </div>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{name:'clips'}" class="nav-link">
                        <div class="nav-link-content">
                            <font-awesome-icon icon="film" class="nav-icon"></font-awesome-icon>
                            <span class="nav-link-text">Видео</span>
                        </div>
                    </router-link>
                </li>
            </ul>

            <template v-slot:footer>
                <ul class="social-icons pl-5 d-block d-md-none">
                    <li class="mr-1">
                        <facebook url="https://www.facebook.com/echotjk" title="Подписывайтесь на нас на фейсбуке"></facebook>
                    </li>
                    <li class="mr-1">
                        <instagram url="https://www.instagram.com/echo.tj/" title="Прямые эфиры, сторисы и многое другое на нашем инстаграм канале"></instagram>
                    </li>
                    <li>
                        <youtube url="https://www.youtube.com/channel/UCmhQHgvauoO6KcCu73l5XDQ" title="Ждите каверы на нашем ютуб канале"></youtube>
                    </li>
                </ul>
            </template>
        </b-sidebar>

        <!--        <div class="row">-->
        <!--            <div class="ml-auto my-3">-->
        <!--                <div id="search-input" v-if="$route.name !== 'search'">-->
        <!--                    <input class="form-control-sm" v-model="searchQuery" type="text" @keydown.enter="navToSearch">-->
        <!--                    <font-awesome-icon class="text-secondary h-text-white" icon="search"-->
        <!--                                       @click="navToSearch">-->
        <!--                    </font-awesome-icon>-->
        <!--                </div>-->


        <!--                <router-link v-if="$route.name !== 'search'" :to="{name:'search'}"-->
        <!--                             class="ml-auto align-self-center mt-1 mr-3">-->
        <!--                    <font-awesome-icon class="text-secondary h-text-white" icon="search"-->
        <!--                                       size="lg"></font-awesome-icon>-->
        <!--                </router-link>-->
        <!--                <div v-if="$route.name === 'search'" class="mr-3 cursor-pointer" @click="closeSearch">-->
        <!--                    <font-awesome-icon class="text-white"-->
        <!--                                       icon="times"-->
        <!--                                       size="lg"></font-awesome-icon>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <div class="row" style="padding-bottom:10rem">
            <router-view></router-view>
        </div>
        <player></player>
    </div>
</template>

<script>
    import {mapGetters} from "vuex";
    import Player from "../components/common/player/Player";
    import {library} from '@fortawesome/fontawesome-svg-core'
    import {
        faCaretDown,
        faSearch,
        faTimes,
        faHome,
        faBars,
        faNewspaper,
        faMusic,
        faCompactDisc,
        faUser,
        faFilm
    } from '@fortawesome/free-solid-svg-icons'
    import Facebook from "../components/common/external-icons/facebook";
    import Instagram from "../components/common/external-icons/instagram";
    import Youtube from "../components/common/external-icons/youtube";

    library.add(faCaretDown, faSearch, faTimes, faHome, faBars, faNewspaper, faMusic,
        faCompactDisc, faUser, faFilm);

    export default {
        name: "PublicApp",
        components: {Youtube, Facebook, Player, Instagram},
        mounted() {
            this.$root.$on('bv::collapse::state', (collapseId, isJustShown) => {
                this.menuCollapsed = !isJustShown;
            })
        },
        created() {
            if (this.user)
                this.$store.commit('SET_AUTH_USER', this.user);
        },
        beforeDestroy() {
            // this.$eventHub.$off('error-reset-requested');
        },
        props: {
            user: {
                type: Object,
                default: null
            }
        },
        data() {
            return {
                searchQuery: null,
                menuCollapsed: false
            }
        },
        methods: {
            logout() {
                this.$store.dispatch('LOG_OUT')
                    .then(_ => {
                        if (this.$route.matched.some(record => record.meta.requiresAuth))
                            this.$router.push({name: 'home'})
                    });
            },
            // closeSearch() {
            //     this.searchQuery = null;
            //     if (this.PREV_ROUTE)
            //         this.$router.push(this.PREV_ROUTE);
            //     else
            //         this.$router.push({name: 'home'});
            // },
            navToSearch() {
                this.$router.push({name: 'search', params: {query: this.searchQuery}})
            }
        },
        computed: {
            isMainOverlayVisible() {
                return this.$store.state.ui.showMainOverlay;
            },
            ...mapGetters([
                'AUTHENTICATED',
                'AVATAR_VARIANT',
                'AUTH_USER',
                'NAV_TYPE',
                'NAV_VARIANT',
                'DEFAULT_BUTTON_CLASSES',
                'PREV_ROUTE'
            ])
        }
    }
</script>

<style scoped>
    .user-name {
        display: flex;
        max-width: 150px;
        max-height: 54px;
        overflow: hidden;
        white-space: nowrap;
        padding-top: 0.5rem;
        color: #9a9da0;
        font-weight: 400;
    }

    #search-input {
        position: relative
    }

    #search-input input {
        background: #1a1d20;
        border: 0;
        border-radius: 2em;
        color: #fff;
        padding: 0 40px 0 15px;
        font-size: 14px;
        margin-right: 12px;
    }

    #search-input input:focus {
        outline: none
    }

    #search-input svg {
        position: absolute;
        right: 24px;
        top: 7px;
        size: 17px
    }
</style>
