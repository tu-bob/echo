<template>
    <div>
        <videos-list></videos-list>
    </div>

</template>

<script>
    import VideosList from "../../common/video/VideosList";
    import MetaTagsMixin from "../../admin/mixins/MetaTagsMixin";

    export default {
        name: "ClipsView",
        data() {
            return {
                title: 'Echo.tj - Главные клипы Таджикистана',
                description: 'Смотрите видео клипы ведущих артистов Таджикистана на Echo.tj'
            }
        },
        mixins: [MetaTagsMixin],
        components: {VideosList}
    }
</script>

<style scoped>

</style>
