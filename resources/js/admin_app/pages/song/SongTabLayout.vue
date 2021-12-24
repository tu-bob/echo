<template>
    <div>
        <section-header>Песни</section-header>
        <router-view></router-view>
    </div>
</template>

<script>
import SectionHeader from "../../components/SectionHeader";
export default {
    name: "SongTabLayout",
    components: {SectionHeader}
}
</script>

<style scoped>

</style>
