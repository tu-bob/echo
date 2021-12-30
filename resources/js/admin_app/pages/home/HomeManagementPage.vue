<template>
    <b-container>
        <b-row>
            <b-col sm="12" md="6" lg="4" class="mb-3 mb-lg-0">
                <statistic-button icon="/icons/svg/user-line.svg" :count="stat.users">Пользователи</statistic-button>
            </b-col>
            <b-col sm="12" md="6" lg="4" class="mb-3 mb-lg-0">
                <statistic-button icon="/icons/svg/visitors.svg" :count="stat.visitors">Посетители</statistic-button>
            </b-col>
            <b-col sm="12" md="6" lg="4" class="mb-3 mb-lg-0">
                <statistic-button icon="/icons/svg/music.svg" :count="stat.songs">Песни</statistic-button>
            </b-col>
        </b-row>
           <div class="mt-3">
               <users-table></users-table>
           </div>

    </b-container>

</template>

<script>
import StatisticButton from "../../components/StatisticButton";
import UsersTable from "../user/UsersTable";

export default {
    name: "HomeManagementPage",
    components: {UsersTable, StatisticButton},
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
