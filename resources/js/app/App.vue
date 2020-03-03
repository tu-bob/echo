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
                    <ul class="navbar-nav mr-auto" v-if="state.auth">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle"
                               href="#"
                               role="button"
                               data-toggle="dropdown">
                                Блог
                                <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu">
                                <router-link to="/blog/posts" class="dropdown-item">Посты</router-link>
                                <router-link to="/blog/posts/edit" class="dropdown-item">Добавить пост</router-link>
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
                                <router-link to="/media/song" class="dropdown-item">Артисты</router-link>
                                <router-link to="/media/song" class="dropdown-item">Песни</router-link>
                                <router-link to="/media/song" class="dropdown-item">Альбомы</router-link>
                                <div class="dropdown-divider"></div>
                                <router-link to="/media/artist" class="dropdown-item">Добавить артиста</router-link>
                                <router-link to="/media/song" class="dropdown-item">Добавить песню</router-link>
                                <router-link to="/media/song" class="dropdown-item">Добавить альбом</router-link>
                            </div>
                        </li>
                    </ul>

                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->

                        <li class="nav-item" v-if="!state.auth">
                            <router-link to="/login" class="dropdown-item">Вход</router-link>
                        </li>

                        <li class="nav-item dropdown" v-else>
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Имя пользователя <span class="caret"></span>
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
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    export default {
        name: "App",
        created() {
            this.$eventHub.$on('authenticated', this.onAuthenticated)
        },
        mounted() {
            this.state.auth = this.authorized;
        },
        props: {
            authorized: {
                type: Boolean
            }
        },
        data() {
            return {
                state: {
                    auth: false
                }
            }
        },
        methods: {
            onAuthenticated() {
                this.state.auth = true;
            },
            logout() {
                axios.post('/auth/logout')
                    .then(response => {
                        this.state.auth = false;
                    this.$router.push('/login');
                    });
            }
        }
    }
</script>

<style scoped>

</style>
