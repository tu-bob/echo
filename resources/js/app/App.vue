<template>
    <div>
        <div class="row bg-dark position-relative">
            <b-navbar toggleable="sm" class="col-8 pl-4" :type="NAV_TYPE" :variant="NAV_VARIANT">
                <b-navbar-toggle target="mainNavBar"></b-navbar-toggle>
                <b-navbar-brand :to="{name: 'home'}" class="py-0" style="width: 128px">
                    <img src="/icons/png/logo-sm.png" alt="echo.tj logo" class="w-100">
                </b-navbar-brand>
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
            <div class="col-4 py-2 pr-4 d-flex">
                <!--                <router-link v-if="!AUTHENTICATED" :class="DEFAULT_BUTTON_CLASSES"-->
                <!--                             :to="{name: 'login'}">Вход-->
                <!--                </router-link>-->
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
        <div style="padding-bottom:10rem">
            <div class="row my-3">
                <div class="ml-auto">
                    <router-link v-if="$route.name !== 'search'" :to="{name:'search'}"
                                 class="ml-auto align-self-center mt-1 mr-3">
                        <font-awesome-icon class="text-secondary h-text-white" icon="search"
                                           size="lg"></font-awesome-icon>
                    </router-link>
                    <div v-else class="mr-3 cursor-pointer" @click="closeSearch">
                        <font-awesome-icon class="text-white"
                                           icon="times"
                                           size="lg"></font-awesome-icon>
                    </div>
                </div>
            </div>

            <!--            <b-alert :show="state.errors"-->
            <!--                     class="mb-5"-->
            <!--                     variant="danger"-->
            <!--                     dismissible>-->
            <!--                <ul>-->
            <!--                    <li v-for="error in state.errors">{{error[0]}}</li>-->
            <!--                </ul>-->
            <!--            </b-alert>-->
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
        faTimes
    } from '@fortawesome/free-solid-svg-icons'

    library.add(faCaretDown, faSearch, faTimes);

    export default {
        name: "App",
        components: {Player},
        created() {
            if (this.user)
                this.$store.commit('SET_AUTH_USER', this.user);
        },
        beforeDestroy() {
            this.$eventHub.$off('error-reset-requested');
        },
        props: {
            user: {
                type: Object,
                default: null
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
                if (this.PREV_ROUTE)
                    this.$router.push(this.PREV_ROUTE);
                else
                    this.$router.push({name: 'home'});
            }
        },
        computed: {
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
</style>
