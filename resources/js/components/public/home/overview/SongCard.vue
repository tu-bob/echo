<template>
    <div class="container pb-3">
        <div class="row w-100" style="color:white">
            <b-img class="bg-laravel thumb"
                   :src="thumbnail"
                   rounded
            ></b-img>
            <div class="info-wrapper">
                <h6 class="mb-0">The separation</h6>
                <span class="text-muted">Rachel Platten</span>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "SongCard",
        props: {
            thumbnail: {
                type: String,
                default: 'https://picsum.photos/1024/400/?image=41'
            }
        }
    }

</script>
<style scoped>
    .thumb {
        object-fit: cover;
        width: 50px !important;
        height: 50px;
    }

    .info-wrapper {
        padding-left: 15px;
        padding-top: 7px;
    }
</style>
