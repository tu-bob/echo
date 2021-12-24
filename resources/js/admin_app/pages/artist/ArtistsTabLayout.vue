<template>
    <div>
        <section-header>Исполнители</section-header>
        <router-view></router-view>
    </div>
</template>

<script>
import SectionHeader from "../../components/SectionHeader";
export default {
    name: "ArtistsTabLayout",
    components: {SectionHeader}
}
</script>

<style scoped>
.tab-header {
    background-color: #F2F2F2;
    text-align: center;
    font-size: 2rem;
    margin-bottom: 2.5rem;
    padding: 4px 0;
}
</style>
