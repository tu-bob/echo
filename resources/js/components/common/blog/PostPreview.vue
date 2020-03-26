<template>
    <div class="card bg-transparent text-light-grey">
        <b-img class="object-fit-contain w-100 card-img-top pb-4" rounded :src="previeImgSrc" alt=""></b-img>
        <h3>Pellentesque et malesuada fames</h3>
        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum
            tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante</p>
        <p>Oct 6th, 2017 by Jon Snow</p>
    </div>
</template>

<script>
    export default {
        name: "PostPreview",
        props: {
            previeImgSrc: {
                default: 'https://img1.goodfon.ru/original/1400x1050/c/dc/nadya-ryzhevolosaya-portret.jpg'
            }
        }
    }
</script>

<style scoped>

</style>
