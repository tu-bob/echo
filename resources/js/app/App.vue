<template>
    <div>
        <nav class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container">
                <button class="navbar-toggler"
                        type="button"
                        data-toggle="collapse"
                        data-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav mr-auto" v-if="AUTHENTICATED">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle"
                               href="#"
                               role="button"
                               data-toggle="dropdown">
                                Блог
                                <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu">
                                <router-link :to="{name: 'posts-table'}" class="dropdown-item">Посты</router-link>
                                <router-link :to="{name: 'post-editor'}" class="dropdown-item">Добавить пост
                                </router-link>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle"
                               href="#"
                               role="button"
                               data-toggle="dropdown">
                                Медиа
                                <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu">
                                <router-link :to="{name: 'artists-table'}" class="dropdown-item">Исполнители
                                </router-link>
                                <router-link :to="{name: 'songs-table'}" class="dropdown-item">Песни</router-link>
                                <router-link :to="{name: 'albums-table'}" class="dropdown-item">Альбомы</router-link>
                                <div class="dropdown-divider"></div>
                                <router-link :to="{name: 'artist-editor'}" class="dropdown-item">Добавить артиста
                                </router-link>
                                <router-link :to="{name: 'song-editor'}" class="dropdown-item">Добавить песню
                                </router-link>
                                <router-link :to="{name: 'album-editor'}" class="dropdown-item">Добавить альбом
                                </router-link>
                            </div>
                        </li>
                    </ul>

                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->

                        <li class="nav-item" v-if="!AUTHENTICATED">
                            <router-link to="/login" class="dropdown-item">Вход</router-link>
                        </li>

                        <li class="nav-item dropdown" v-else>
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span v-if="AUTHENTICATED">{{AUTH_USER.name}}</span> <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#" @click="logout"> Выйти из системы </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
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
