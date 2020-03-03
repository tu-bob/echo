<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Регистрация</div>

                <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">Имя</label>

                        <div class="col-md-6">
                            <input id="name"
                                   v-model="name"
                                   type="text"
                                   class="form-control"
                                   name="name"
                                   required
                                   autocomplete="name"
                                   autofocus>

                            <!--                                @error('name')-->
                            <!--                                <span class="invalid-feedback" role="alert">-->
                            <!--                                        <strong>{{ $message }}</strong>-->
                            <!--                                    </span>-->
                            <!--                                @enderror-->
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">E-mail</label>

                        <div class="col-md-6">
                            <input id="email"
                                   v-model="email"
                                   type="email"
                                   class="form-control"
                                   name="email"
                                   required
                                   autocomplete="email">
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
                                   autocomplete="new-password">

                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right"> Подтверждение
                            пароля</label>

                        <div class="col-md-6">
                            <input id="password-confirm"
                                   v-model="passwordConfirmation"
                                   type="password"
                                   class="form-control"
                                   name="password_confirmation"
                                   required
                                   autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button @click="submit" class="btn btn-primary">
                                Регистрация
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Register",
        data() {
            return {
                name: null,
                email: null,
                password: null,
                passwordConfirmation: null
            }
        },
        methods: {
            async submit() {
                try {
                    let data = {
                        name: this.name,
                        email: this.email,
                        password: this.password,
                        password_confirmation: this.passwordConfirmation
                    };

                    const response = await axios.post('/auth/register', data);
                } catch (e) {

                }
            }
        }
    }
</script>

<style scoped>

</style>
