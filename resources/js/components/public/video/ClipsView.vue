<template>
    <div>
        <videos-list></videos-list>
    </div>

</template>

<script>
    import VideosList from "../../common/video/VideosList";
    import TitleMixin from "../../admin/mixins/TitleMixin";

    export default {
        name: "ClipsView",
        data() {
            return {
                title: 'Echo.tj - Главные клипы Таджикистана'
            }
        },
        mixins: [TitleMixin],
        components: {VideosList}
    }
</script>

<style scoped>

</style>
