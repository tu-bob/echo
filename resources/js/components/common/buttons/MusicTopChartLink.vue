<template>
    <router-link :to="{name:'music-charts'}" class="d-inline-block px-5 py-2 rounded-lg text-lg-h1 font-weight-bold cursor-pointer hover-scale hover-text-white"
       style="background: linear-gradient(90deg, rgba(131,58,180,1) 0%, rgba(253,29,29,1) 50%, rgba(252,176,69,1) 100%);">
        МУЗЫКАЛЬНЫЙ ТОП
    </router-link>
</template>

<script>
export default {
    name: "MusicTopChartLink"
}
</script>
