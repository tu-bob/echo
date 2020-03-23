<template>
    <div>
        <div class="row bg-dark">
            <b-navbar toggleable="sm" class="col-4 col-md-4 pl-4" type="dark" variant="dark">
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

                <router-link v-if="!AUTHENTICATED" class="ml-auto btn btn-dark" :to="{name: 'login'}">Вход
                </router-link>
                <b-dropdown v-else class="ml-auto" variant="dark" right :text="AUTH_USER.name" >
                    <b-dropdown-item @click="logout">Выйти из профиля</b-dropdown-item>
                </b-dropdown>
            </div>
        </div>
        <div class="container mt-5">
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
    </div>
</template>

<script>
    import {mapGetters} from "vuex";

    export default {
        name: "App",
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
                'AUTH_USER'
            ])
        }
    }
</script>

<style scoped>

</style>
