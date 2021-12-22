<template>
    <div class="bg-white" style="height: 100vh">

        <div id="tMainSpinner" :class="{'d-none':!isMainOverlayVisible}">
            <div class="spinner"></div>
        </div>

        <div class="d-flex h-100">
            <!--Sidebar menu-->
            <div id="side-menu" style="width: 240px; height: 100%" :v-model="showSideBar" title="Sidebar" >
                <ul class="main-nav">
                    <li class="nav-item">
                        <router-link :to="{name:'a.home'}" class="nav-link">
                            <div class="nav-link-content">
                                <font-awesome-icon icon="home" class="nav-icon"></font-awesome-icon>
                                <span class="nav-link-text">Главная</span>
                            </div>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{name:'a.blog'}" class="nav-link">
                            <div class="nav-link-content">
                                <font-awesome-icon icon="newspaper" class="nav-icon"></font-awesome-icon>
                                <span class="nav-link-text">Блог</span>
                            </div>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{name:'a.song'}" class="nav-link">
                            <div class="nav-link-content">
                                <font-awesome-icon icon="music" class="nav-icon"></font-awesome-icon>
                                <span class="nav-link-text">Песни</span>
                            </div>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{name:'a.album'}" class="nav-link">
                            <div class="nav-link-content">
                                <font-awesome-icon icon="compact-disc" class="nav-icon"></font-awesome-icon>
                                <span class="nav-link-text">Альбомы</span>
                            </div>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{name:'a.artist'}" class="nav-link">
                            <div class="nav-link-content">
                                <font-awesome-icon icon="user" class="nav-icon"></font-awesome-icon>
                                <span class="nav-link-text">Исполнители</span>
                            </div>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{name:'a.video'}" class="nav-link">
                            <div class="nav-link-content">
                                <font-awesome-icon icon="film" class="nav-icon"></font-awesome-icon>
                                <span class="nav-link-text">Видео</span>
                            </div>
                        </router-link>
                    </li>
                </ul>

            </div>

            <router-view></router-view>
        </div>

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
    name: "AdminApp",
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
            showSideBar: true
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
.nav-link {
    padding-right: 0 !important;
}

.router-link-active .nav-link-content{
    background: white;
    border-radius: 20px 0 0 20px;
    color:#000000;
}
</style>
