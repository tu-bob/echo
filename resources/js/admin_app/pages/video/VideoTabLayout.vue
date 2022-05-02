<template>
    <div>
        <section-header>Видео</section-header>
        <router-view></router-view>
    </div>
</template>

<script>
import SectionHeader from "../../components/SectionHeader";
export default {
    name: "VideoTabLayout",
    components: {SectionHeader}
}
</script>
