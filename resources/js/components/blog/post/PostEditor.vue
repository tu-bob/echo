<template>
    <div>
        <div class="col-12 mb-4">
            <summernote></summernote>
        </div>

        <div class="col-12 text-center">
            <button class="btn btn-primary">Сохранить</button>
        </div>
    </div>

</template>

<script>
    import Summernote from "../../common/summernote/Summernote";
    export default {
        name: "PostEditor",
        components: {Summernote}
    }
</script>

<style scoped>

</style>
