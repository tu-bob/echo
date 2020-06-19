<template>
    <div class="h-100 container-fluid">
        <!--        <b-overlay variant="dark" no-wrap :show="isMainOverlayVisible" spinner-variant="light">-->
        <!--        </b-overlay>-->
        <div id="tMainSpinner" :class="{'d-none':!isMainOverlayVisible}">
            <div class="spinner"></div>
        </div>
        <div class="row bg-dark position-relative divider-bottom">
            <b-navbar toggleable="sm" class="col-8 pl-4" :type="NAV_TYPE" :variant="NAV_VARIANT">
                <b-navbar-toggle target="mainNavBar" v-if="AUTHENTICATED"></b-navbar-toggle>
                <b-navbar-brand title="Перейти на главную" :to="{name: 'home'}" class="py-0 d-none d-md-block">
                    <img src="/icons/png/logo-sm.png" alt="echo.tj logo" style="height: 60px">
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

                <!--                <router-link :to="{name:'home'}" class="mr-auto" title="Перейти на главную">-->
                <!--                    <font-awesome-icon class="text-secondary h-text-white"-->
                <!--                                       icon="home"-->
                <!--                                       size="lg">-->
                <!--                    </font-awesome-icon>-->
                <!--                </router-link>-->
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
            <div class="col-4 py-2 pr-4 d-flex align-items-center justify-content-end">
                <ul class="social-icons">
                    <li class="mr-1">
                        <a href="https://www.facebook.com/echotjk" target="_blank" aria-label="Эхо на фейсбуке">
                            <svg xmlns="http://www.w3.org/2000/svg" class="social-icon" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
<path d="M384,176h-96v-64c0-17.664,14.336-32,32-32h32V0h-64l0,0c-53.024,0-96,42.976-96,96v80h-64v80h64v256  h96V256h64L384,176z"/>
                                <g>
</g>
                                <g>
</g>
                                <g>
</g>
                                <g>
</g>
                                <g>
</g>
                                <g>
</g>
                                <g>
</g>
                                <g>
</g>
                                <g>
</g>
                                <g>
</g>
                                <g>
</g>
                                <g>
</g>
                                <g>
</g>
                                <g>
</g>
                                <g>
</g>
</svg>
                        </a>
                    </li>
                    <li class="mr-1">
                        <a href="https://www.instagram.com/echo.tj/" target="_blank" aria-label="Эхо на инстаграме">
                            <svg xmlns="http://www.w3.org/2000/svg" class="social-icon"  version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
<linearGradient id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="-46.0041" y1="634.1208" x2="-32.9334" y2="647.1917" gradientTransform="matrix(32 0 0 -32 1519 20757)">
	<stop offset="0" style="stop-color:#FFC107"/>
    <stop offset="0.507" style="stop-color:#F44336"/>
    <stop offset="0.99" style="stop-color:#9C27B0"/>
</linearGradient>
                                <path d="M352,0H160C71.648,0,0,71.648,0,160v192c0,88.352,71.648,160,160,160h192  c88.352,0,160-71.648,160-160V160C512,71.648,440.352,0,352,0z M464,352c0,61.76-50.24,112-112,112H160c-61.76,0-112-50.24-112-112  V160C48,98.24,98.24,48,160,48h192c61.76,0,112,50.24,112,112V352z"/>
                                <linearGradient id="SVGID_2_" gradientUnits="userSpaceOnUse" x1="-42.2971" y1="637.8279" x2="-36.6404" y2="643.4846" gradientTransform="matrix(32 0 0 -32 1519 20757)">
	<stop offset="0" style="stop-color:#FFC107"/>
                                    <stop offset="0.507" style="stop-color:#F44336"/>
                                    <stop offset="0.99" style="stop-color:#9C27B0"/>
</linearGradient>
                                <path d="M256,128c-70.688,0-128,57.312-128,128s57.312,128,128,128s128-57.312,128-128  S326.688,128,256,128z M256,336c-44.096,0-80-35.904-80-80c0-44.128,35.904-80,80-80s80,35.872,80,80  C336,300.096,300.096,336,256,336z"/>
                                <linearGradient id="SVGID_3_" gradientUnits="userSpaceOnUse" x1="-35.5456" y1="644.5793" x2="-34.7919" y2="645.3331" gradientTransform="matrix(32 0 0 -32 1519 20757)">
	<stop offset="0" style="stop-color:#FFC107"/>
                                    <stop offset="0.507" style="stop-color:#F44336"/>
                                    <stop offset="0.99" style="stop-color:#9C27B0"/>
</linearGradient>
                                <circle cx="393.6" cy="118.4" r="17.056"/>
                                <g>
</g>
                                <g>
</g>
                                <g>
</g>
                                <g>
</g>
                                <g>
</g>
                                <g>
</g>
                                <g>
</g>
                                <g>
</g>
                                <g>
</g>
                                <g>
</g>
                                <g>
</g>
                                <g>
</g>
                                <g>
</g>
                                <g>
</g>
                                <g>
</g>
</svg>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.youtube.com/channel/UCmhQHgvauoO6KcCu73l5XDQ" target="_blank" aria-label="Эхо на ютюбе">
                            <svg xmlns="http://www.w3.org/2000/svg" class="social-icon" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 310 310" style="enable-background:new 0 0 310 310;" xml:space="preserve">
<g id="XMLID_822_">
	<path id="XMLID_823_" d="M297.917,64.645c-11.19-13.302-31.85-18.728-71.306-18.728H83.386c-40.359,0-61.369,5.776-72.517,19.938   C0,79.663,0,100.008,0,128.166v53.669c0,54.551,12.896,82.248,83.386,82.248h143.226c34.216,0,53.176-4.788,65.442-16.527   C304.633,235.518,310,215.863,310,181.835v-53.669C310,98.471,309.159,78.006,297.917,64.645z M199.021,162.41l-65.038,33.991   c-1.454,0.76-3.044,1.137-4.632,1.137c-1.798,0-3.592-0.484-5.181-1.446c-2.992-1.813-4.819-5.056-4.819-8.554v-67.764   c0-3.492,1.822-6.732,4.808-8.546c2.987-1.814,6.702-1.938,9.801-0.328l65.038,33.772c3.309,1.718,5.387,5.134,5.392,8.861   C204.394,157.263,202.325,160.684,199.021,162.41z"/>
</g>
                                <g>
</g>
                                <g>
</g>
                                <g>
</g>
                                <g>
</g>
                                <g>
</g>
                                <g>
</g>
                                <g>
</g>
                                <g>
</g>
                                <g>
</g>
                                <g>
</g>
                                <g>
</g>
                                <g>
</g>
                                <g>
</g>
                                <g>
</g>
                                <g>
</g>
</svg>
                        </a>
                    </li>

                </ul>


                <!--                <div class="d-flex align-items-center h-100">-->
                <!--                    <a class="mr-2" target="_blank" title="Смотрите каверы, интервью и прочее на нашем ютюб канале"-->
                <!--                       href="https://www.youtube.com/channel/UCmhQHgvauoO6KcCu73l5XDQ">-->
                <!--                        <img class="icon-btn-md" src="/icons/svg/youtube.svg">-->
                <!--                    </a>-->
                <!--                    <a class="mr-2" target="_blank" title="Оставайтесь с нами Вконтакте"-->
                <!--                       href="https://vk.com/echotj">-->
                <!--                        <img class="icon-btn-md" src="/icons/svg/vk.svg">-->
                <!--                    </a>-->
                <!--                    <a class="mr-2" target="_blank" title="Шифруйтесь с нами в телеграме"-->
                <!--                       href="https://t.me/echotj">-->
                <!--                        <img class="icon-btn-md" src="/icons/svg/telegram.svg">-->
                <!--                    </a>-->
                <!--                    <a class="mr-2" target="_blank" title="Подписывайтесь на нас в инстаграме"-->
                <!--                       href="https://www.instagram.com/echo.tj/">-->
                <!--                        <img class="icon-btn-md" src="/icons/svg/instagram.svg">-->
                <!--                    </a>-->
                <!--                    <a target="_blank" title="Следите за нами на фейсбуке"-->
                <!--                       href="https://www.facebook.com/Echotj-107437064197171">-->
                <!--                        <img class="icon-btn-md" src="/icons/svg/facebook.svg">-->
                <!--                    </a>-->
                <!--                </div>-->
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
                <div v-if="$route.name === 'search'" class="mr-3 cursor-pointer" @click="closeSearch">
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
