<template>
    <div>
        <section-header>Главная</section-header>
        <router-view></router-view>
    </div>
</template>

<script>
import SectionHeader from "../../components/SectionHeader";
export default {
    name: "HomePage",
    components: {SectionHeader}
}
</script>
