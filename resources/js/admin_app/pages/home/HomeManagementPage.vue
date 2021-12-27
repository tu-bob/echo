<template>
    <b-container>
        <b-row>
            <b-col sm="12" md="6" lg="4" class="mb-3 mb-lg-0">
                <statistic-button icon="/icons/svg/user-line.svg" :count="stat.users">users</statistic-button>
            </b-col>
            <b-col sm="12" md="6" lg="4" class="mb-3 mb-lg-0">
                <statistic-button icon="/icons/svg/visitors.svg" :count="stat.visitors">visitors</statistic-button>
            </b-col>
            <b-col sm="12" md="6" lg="4" class="mb-3 mb-lg-0">
                <statistic-button icon="/icons/svg/music.svg" :count="stat.songs">songs</statistic-button>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
import StatisticButton from "../../components/StatisticButton";
export default {
    name: "HomeManagementPage",
    components: {StatisticButton},
    mounted() {
        this.fetchOverallStatistics()
    },
    data(){
        return{
            stat: {
                users: 0,
                visitors: 0,
                songs: 0
            }
        }
    },
    methods:{
        fetchOverallStatistics(){
            axios.get('/statistics/overall').then(response => {
                this.stat = response
            })
        }
    }
}
</script>

<style scoped>

</style>
