<template>
    <div class="bg-white" style="font-family:Roboto, sans-serif; min-height: 100vh">

        <div id="tMainSpinner" :class="{'d-none':!isMainOverlayVisible}">
            <div class="spinner"></div>
        </div>

        <div class="hamburger-wrapper">
            <button class="hamburger hamburger--spin js-hamburger d-md-none"
                    @click="menuCollapsed = !menuCollapsed"
                    :class="{'is-active': !menuCollapsed}"
                    type="button">
                      <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                      </span>
            </button>
        </div>


        <!--Sidebar menu-->
        <div id="side-menu" v-if="!menuCollapsed || windowWidth > 768" style="width: 240px; min-height: 100vh"
             :v-model="showSideBar"
             title="Sidebar">
            <router-link :to="{name:'home'}">
                <b-img center class="w-50 my-4" src="/icons/png/logo_echo_full_color.png"></b-img>
            </router-link>
            <ul class="main-nav">
                <li class="nav-item">
                    <router-link :to="{name:'a.home.management'}" class="nav-link">
                        <div class="nav-link-content">
                            <font-awesome-icon icon="home" class="nav-icon"></font-awesome-icon>
                            <span class="nav-link-text">Главная</span>
                        </div>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{name:'a.blog.management'}" class="nav-link">
                        <div class="nav-link-content">
                            <font-awesome-icon icon="newspaper" class="nav-icon"></font-awesome-icon>
                            <span class="nav-link-text">Блог</span>
                        </div>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{name:'a.song.management'}" class="nav-link">
                        <div class="nav-link-content">
                            <font-awesome-icon icon="music" class="nav-icon"></font-awesome-icon>
                            <span class="nav-link-text">Песни</span>
                        </div>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{name:'a.album.management'}" class="nav-link">
                        <div class="nav-link-content">
                            <font-awesome-icon icon="compact-disc" class="nav-icon"></font-awesome-icon>
                            <span class="nav-link-text">Альбомы</span>
                        </div>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{name:'a.artists.management'}" class="nav-link">
                        <div class="nav-link-content">
                            <font-awesome-icon icon="user" class="nav-icon"></font-awesome-icon>
                            <span class="nav-link-text">Исполнители</span>
                        </div>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{name:'a.video.management'}" class="nav-link">
                        <div class="nav-link-content">
                            <font-awesome-icon icon="film" class="nav-icon"></font-awesome-icon>
                            <span class="nav-link-text">Видео</span>
                        </div>
                    </router-link>
                </li>
            </ul>

        </div>

        <router-view class="main-view"></router-view>


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
import WindowsDimensionsMixin from "../components/admin/mixins/WindowsDimensionsMixin";

library.add(faCaretDown, faSearch, faTimes, faHome, faBars, faNewspaper, faMusic,
    faCompactDisc, faUser, faFilm);

export default {
    name: "AdminApp",
    created() {
        if (this.user)
            this.$store.commit('SET_AUTH_USER', this.user);
    },
    mixins: [WindowsDimensionsMixin],
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
            showSideBar: true,
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

.router-link-active .nav-link-content {
    background: white;
    border-radius: 20px 0 0 20px;
    color: #000000;
}

.hamburger-wrapper {
    font-size: 20px;
    background-color: #222222;
    position: absolute;
    top: 0;
    left: 0;
    padding: 5px 18px;
    z-index: 11;
    margin-left: 16px;
    border-radius: 0 0 7px 7px;
}

#side-menu {
    position: absolute;
    left: 0;
    right: 0;
    z-index: 10;
}

.main-view {
    width: calc(100% - 240px);
    margin-left: 240px;
}

@media only screen and (max-width: 767px) {
    .main-view {
        width: 100%;
        margin-left: 0;
    }
}
</style>
