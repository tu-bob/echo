<template>

        <div class="mx-auto col-md-8">
            <div class="card">
                <div class="card-header">Вход</div>

                <div class="card-body">

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">E-mail</label>

                        <div class="col-md-6">
                            <input id="email"
                                   v-model="email"
                                   type="email"
                                   class="form-control"
                                   name="email"
                                   required
                                   autocomplete="email"
                                   autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">Пароль</label>

                        <div class="col-md-6">
                            <input id="password"
                                   v-model="password"
                                   type="password"
                                   class="form-control"
                                   name="password"
                                   required
                                   autocomplete="current-password">

                            <!--                                @error('password')-->
                            <!--                                <span class="invalid-feedback" role="alert">-->
                            <!--                                        <strong>{{ $message }}</strong>-->
                            <!--                                    </span>-->
                            <!--                                @enderror-->
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">

                                <label class="form-check-label" for="remember">
                                    Запомнить меня
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" @click="submit" class="btn btn-primary">
                                Войти
                            </button>

                            <a class="btn btn-link" href="#">
                                Забыли пароль?
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
    import ResetErrorsMixin from "../admin/mixins/ResetErrorsMixin";

    export default {
        name: "Login",
        mixins:[ResetErrorsMixin],
        props: {
            redirectUrl: {
                type: String
            }
        },
        data() {
            return {
                email: null,
                password: null
            }
        },
        methods: {
            submit() {
                this.$store.dispatch('LOG_IN', {
                    email: this.email,
                    password: this.password
                })
                    .then(_ => {
                        if (this.redirectUrl)
                            this.$router.push(this.redirectUrl);
                        else
                            this.$router.push({name: 'home'})
                    })
            }
        }
    }
</script>

<style scoped>

</style>
