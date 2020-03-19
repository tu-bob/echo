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
                                <router-link to="/media/artists" class="dropdown-item">Исполнители</router-link>
                                <router-link to="/media/songs" class="dropdown-item">Песни</router-link>
                                <router-link to="/media/albums" class="dropdown-item">Альбомы</router-link>
                                <div class="dropdown-divider"></div>
                                <router-link to="/media/artist" class="dropdown-item">Добавить артиста</router-link>
                                <router-link to="/media/song" class="dropdown-item">Добавить песню</router-link>
                                <router-link to="/media/album" class="dropdown-item">Добавить альбом</router-link>
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
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span v-if="user">{{user.name}}</span> <span class="caret"></span>
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
            <b-alert :show="state.errors"
                     class="mb-5"
                     variant="danger"
                     dismissible>
                <ul>
                    <li v-for="error in state.errors">{{error[0]}}</li>
                </ul>
            </b-alert>
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    export default {
        name: "App",
        created() {
            this.state.auth = this.authorized;

            this.$eventHub.$on('authenticated', this.onAuthenticated);
            this.$eventHub.$on('validation-failed', this.onValidationFailed);
            this.$eventHub.$on('error-reset-requested', this.onErrorResetRequested);
        },
        beforeDestroy() {
            this.$eventHub.$off('authenticated');
            this.$eventHub.$off('validation-failed');
            this.$eventHub.$off('error-reset-requested');
        },
        props: {
            authorized: {
                type: Boolean
            }
        },
        data() {
            return {
                state: {
                    auth: false,
                    errors: null
                },
                user: null
            }
        },
        methods: {
            onAuthenticated() {
                this.state.auth = true;
            },
            onValidationFailed(e) {
                this.state.errors = e.data.errors;
            },
            onErrorResetRequested(e) {
                this.state.errors = null;
            },
            logout() {
                axios.post('/auth/logout')
                    .then(response => {
                        this.state.auth = false;
                        this.$router.push('/login');
                    });
            },
            fetchUser() {
                axios.get('/auth/user')
                    .then(user => this.user = user);
            },
            resetLayout() {
                this.errors = null;
            }
        },
        watch: {
            'state.auth'() {
                if (this.state.auth)
                    this.fetchUser();
            },
            $route() {
                this.resetLayout();
            }
        }
    }
</script>

<style scoped>

</style>
