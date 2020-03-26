<template>
    <div class="card-columns">
        <post-preview ></post-preview>
        <post-preview ></post-preview>
        <post-preview  previe-img-src="https://wallbox.ru/resize/640x960/wallpapers/main2/201727/149959744059620a80e50b82.55125966.jpg"></post-preview>
        <post-preview ></post-preview>
        <post-preview ></post-preview>
        <post-preview ></post-preview>
    </div>

</template>

<script>
    import PostPreview from "../../common/blog/PostPreview";
    export default {
        name: "News",
        components: {PostPreview}
    }
</script>

<style scoped>

</style>
