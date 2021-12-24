<template>
    <div>
        <section-header>Альбомы</section-header>
        <router-view></router-view>
    </div>
</template>

<script>
import SectionHeader from "../../components/SectionHeader";
export default {
    name: "AlbumsTabLayout",
    components: {SectionHeader}
}
</script>

<style scoped>

</style>
