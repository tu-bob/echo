<template>
    <div class="bg-laravel p-0 container">
        <router-view></router-view>
        <b-alert :show="Boolean(htmlValidationError)"
                 class="mb-5"
                 variant="danger"
                 dismissible>
            <ul>
                <li v-for="error in htmlValidationError">{{error[0]}}</li>
            </ul>
        </b-alert>
    </div>
</template>

<script>
    import LaravelBackground from "../../common/mixins/LaravelBackground";

    export default {
        name: "BlogAdminView",
        mixins: [LaravelBackground],
        computed: {
            htmlValidationError() {
                let errors = this.$store.getters.HTML_ERRORS(422);
                if (errors.length > 0) {
                    let error = errors[0];
                    return error.data.errors;
                }

                return null;
            }
        }
    }
</script>

<style scoped>

</style>
