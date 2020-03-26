<template>
    <div class="card-columns">

        <post-preview  previe-img-src="https://wallbox.ru/resize/640x960/wallpapers/main2/201727/149959744059620a80e50b82.55125966.jpg"></post-preview>
        <post-preview previe-img-src="https://avatars.mds.yandex.net/get-pdb/902733/5ecc137d-5226-4a5f-8574-b50be6ce5d51/s1200?webp=false"></post-preview>
        <post-preview previe-img-src="https://s1.1zoom.me/b5050/56/329995-pinkoo39_2880x1800.jpg"></post-preview>
        <post-preview ></post-preview>
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
