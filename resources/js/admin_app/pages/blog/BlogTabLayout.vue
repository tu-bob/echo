<template>
    <div>
        <section-header>Блог</section-header>
        <router-view></router-view>
    </div>

</template>

<script>
import SectionHeader from "../../components/SectionHeader";
export default {
    name: "BlogTabLayout",
    components: {SectionHeader}
}
</script>

<style scoped>

</style>
