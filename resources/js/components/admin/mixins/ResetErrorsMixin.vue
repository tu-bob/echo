<template>

</template>

<script>
    export default {
        name: "ResetErrorsMixin",
        beforeRouteLeave(to, from, next) {
            this.$store.commit('RESET_HTML_ERRORS');
            next();
        }
    }
</script>

<style scoped>

</style>
