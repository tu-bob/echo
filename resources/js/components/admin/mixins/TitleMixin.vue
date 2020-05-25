<template>

</template>

<script>
    import {mapGetters} from "vuex";

    export default {
        name: "TitleMixin",
        created() {
            this.updateTitle();
        },
        methods: {
            updateTitle() {
                if (!this.ACTIVE_SONG) {
                    const title = this.getTitle(this);
                    document.title = title ? title : 'Echo.tj - Музыкальное наследие Таджикистана'
                }
            },
            getTitle() {
                if (this.title) {
                    return typeof this.title === 'function'
                        ? this.title.call()
                        : this.title
                }
            }
        },
        computed: {
            ...mapGetters([
                'ACTIVE_SONG'
            ])
        }
    }
</script>

<style scoped>

</style>
