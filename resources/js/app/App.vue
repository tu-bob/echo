<template>
    <div class="container">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container">
                <button class="navbar-toggler"
                        type="button"
                        data-toggle="collapse"
                        data-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav mr-auto">
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
                </div>
            </div>
        </nav>
        <!--        <nav class="navbar navbar-expand-lg navbar-light bg-light">-->
        <!--            <div class="collapse navbar-collapse">-->
        <!--                <div class="navbar-nav">-->
        <!--                    <router-link to="/blog/posts" class="nav-item nav-link">Home</router-link>-->
        <!--                    <router-link to="/blog/posts/edit" class="nav-item nav-link">Blog</router-link>-->
        <!--                    <router-link to="/media/song" class="nav-item nav-link">Media</router-link>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </nav>-->
        <br/>
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        name: "App",
        mounted() {
        },
        data() {
            return {}
        },
        methods: {}
    }
</script>

<style scoped>

</style>
