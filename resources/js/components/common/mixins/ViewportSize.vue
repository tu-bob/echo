<template>

</template>

<script>
    export default {
        name: "viewportSize",
        mounted() {
            window.addEventListener('resize', () => {
                this.windowHeight = window.innerHeight;
                this.windowWidth = window.innerWidth;
            });
        },
        data() {
            return {
                windowHeight: window.innerHeight,
                windowWidth: window.innerWidth,
            }
        }
    }
</script>

<style scoped>

</style>
