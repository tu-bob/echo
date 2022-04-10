<template>
    <router-view></router-view>
</template>

<script>
export default {
    name: "EntryPoint",
    props:{
        user: Object
    },
    mounted() {
        this.$store.dispatch('FETCH_USER')
    }
}
</script>
