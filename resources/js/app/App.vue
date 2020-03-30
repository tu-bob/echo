<template>
    <div>
        <div class="row bg-dark">
            <b-navbar toggleable="sm" class="col-4 col-md-4 pl-4" :type="NAV_TYPE" :variant="NAV_VARIANT">
                <b-navbar-toggle target="mainNavBar"></b-navbar-toggle>
                <b-collapse is-nav id="mainNavBar">
                    <b-navbar-nav>
                        <b-nav-item :to="{name: 'home'}">Home</b-nav-item>

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
                    </b-navbar-nav>
                </b-collapse>
            </b-navbar>
            <div class="col-1 col-md-4"></div>
            <div class="col-7 col-md-4 py-2 pr-4 row">

                <router-link v-if="!AUTHENTICATED" class="ml-auto" :class="DEFAULT_BUTTON_CLASSES"
                             :to="{name: 'login'}">Вход
                </router-link>
                <template v-else>
                    <b-avatar class="ml-auto mr-3" :variant="AVATAR_VARIANT"></b-avatar>
                    <div class="dropdown">
                        <button class="btn dropdown-toggle"
                                :class="DEFAULT_BUTTON_CLASSES"
                                type="button"
                                id="profileMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{AUTH_USER.name}}
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileMenu">
                            <a class="dropdown-item" href="#" @click="logout">Выйти</a>
                        </div>
                    </div>
                </template>
            </div>
        </div>
        <div class="mt-5">
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
        },
        computed: {
            ...mapGetters([
                'AUTHENTICATED',
                'AVATAR_VARIANT',
                'AUTH_USER',
                'NAV_TYPE',
                'NAV_VARIANT',
                'DEFAULT_BUTTON_CLASSES'
            ])
        }
    }
</script>

<style scoped>

</style>
