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
