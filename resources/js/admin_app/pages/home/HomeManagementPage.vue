<template>
    <b-container>
        <b-row>
            <b-col sm="12" md="6" lg="4" class="mb-3 mb-lg-0">
                <statistic-button icon="/icons/svg/user-line.svg">users</statistic-button>
            </b-col>
            <b-col sm="12" md="6" lg="4" class="mb-3 mb-lg-0">
                <statistic-button icon="/icons/svg/visitors.svg">visitors</statistic-button>
            </b-col>
            <b-col sm="12" md="6" lg="4" class="mb-3 mb-lg-0">
                <statistic-button icon="/icons/svg/music.svg">songs</statistic-button>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
import StatisticButton from "../../components/StatisticButton";
export default {
    name: "HomeManagementPage",
    components: {StatisticButton}
}
</script>

<style scoped>

</style>
