<template>
    <div class="h-100 container-fluid">
        <!--        <b-overlay variant="dark" no-wrap :show="isMainOverlayVisible" spinner-variant="light">-->
        <!--        </b-overlay>-->
        <div id="tMainSpinner" :class="{'d-none':!isMainOverlayVisible}">
            <div class="spinner"></div>
        </div>
        <div class="row bg-dark position-relative">
            <b-navbar toggleable="sm" class="col-8 pl-4" :type="NAV_TYPE" :variant="NAV_VARIANT">
                <b-navbar-toggle target="mainNavBar" v-if="AUTHENTICATED"></b-navbar-toggle>
                <b-navbar-brand title="Перейти на главную" :to="{name: 'home'}" class="py-0 d-none d-md-block">
                    <img src="/icons/png/logo-sm.png" alt="echo.tj logo" style="height: 30px">
                </b-navbar-brand>
                <router-link :to="{name:'home'}" class="mr-auto" title="Перейти на главную">
                    <font-awesome-icon class="text-secondary h-text-white"
                                       icon="home"
                                       size="lg">
                    </font-awesome-icon>
                </router-link>
                <b-collapse is-nav id="mainNavBar">
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
                </b-collapse>
            </b-navbar>
            <div class="col-4 py-2 pr-4 d-flex align-items-baseline justify-content-end">
                <div class="d-flex align-items-center h-100">
                    <a class="mr-2" target="_blank" title="Смотрите каверы, интервью и прочее на нашем ютюб канале"
                       href="https://www.youtube.com/channel/UCmhQHgvauoO6KcCu73l5XDQ">
                        <img class="icon-btn-md" src="/icons/svg/youtube.svg">
                    </a>
                    <a class="mr-2" target="_blank" title="Оставайтесь с нами Вконтакте"
                       href="https://vk.com/echotj">
                        <img class="icon-btn-md" src="/icons/svg/vk.svg">
                    </a>
                    <a class="mr-2" target="_blank" title="Шифруйтесь с нами в телеграме"
                       href="https://t.me/echotj">
                        <img class="icon-btn-md" src="/icons/svg/telegram.svg">
                    </a>
                    <a class="mr-2" target="_blank" title="Подписывайтесь на нас в инстаграме"
                       href="https://www.instagram.com/echo.tj/">
                        <img class="icon-btn-md" src="/icons/svg/instagram.svg">
                    </a>
                    <a target="_blank" title="Следите за нами на фейсбуке"
                       href="https://www.facebook.com/Echotj-107437064197171">
                        <img class="icon-btn-md" src="/icons/svg/facebook.svg">
                    </a>
                </div>
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
        <div class="row">
            <div class="ml-auto my-3">
                <div id="search-input" v-if="$route.name !== 'search'">
                    <input class="form-control-sm" v-model="searchQuery" type="text" @keydown.enter="navToSearch">
                    <font-awesome-icon class="text-secondary h-text-white" icon="search"
                                       @click="navToSearch">
                    </font-awesome-icon>
                </div>


                <!--                <router-link v-if="$route.name !== 'search'" :to="{name:'search'}"-->
                <!--                             class="ml-auto align-self-center mt-1 mr-3">-->
                <!--                    <font-awesome-icon class="text-secondary h-text-white" icon="search"-->
                <!--                                       size="lg"></font-awesome-icon>-->
                <!--                </router-link>-->
                <div v-else class="mr-3 cursor-pointer" @click="closeSearch">
                    <font-awesome-icon class="text-white"
                                       icon="times"
                                       size="lg"></font-awesome-icon>
                </div>
            </div>
        </div>
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
        faHome
    } from '@fortawesome/free-solid-svg-icons'

    library.add(faCaretDown, faSearch, faTimes, faHome);

    export default {
        name: "App",
        components: {Player},
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
                searchQuery: null
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
            closeSearch() {
                this.searchQuery = null;
                if (this.PREV_ROUTE)
                    this.$router.push(this.PREV_ROUTE);
                else
                    this.$router.push({name: 'home'});
            },
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
