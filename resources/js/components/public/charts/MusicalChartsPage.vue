<template>
    <div class="container pt-5">
        <div class="row page-header">
            <h1 class="">Музыкальный топ</h1>
        </div>

        <div class="row mb-5">
            <div class="col-12 col-md-4 pr-md-2 mb-3 mb-md-0" @click="chatTab = 'daily'">
                <button class="w-100" :class="getTabClass('daily')">ЗА ДЕНЬ</button>
            </div>
            <div class="col-12 col-md-4 pl-md-1 pr-md-1 mb-3 mb-md-0">
                <button class="w-100" :class="getTabClass('weekly')" @click="chatTab = 'weekly'">ЗА НЕДЕЛЮ</button>
            </div>
            <div class="col-12 col-md-4 pl-md-1">
                <button class="w-100" :class="getTabClass('monthly')" @click="chatTab = 'monthly'">ЗА МЕСЯЦ</button>
            </div>

        </div>

        <songs-list v-if="playlist && playlist.songs" :playlist="playlist.songs"></songs-list>
    </div>
</template>

<script>
import SongsList from "../../common/music/song/SongsList";

export default {
    name: "MusicalChartsPage",
    components: {SongsList},
    props: {
        tab: {
            type: String,
            default: 'weekly'
        }
    },
    mounted() {
        this.fetchChartSongs()
    },
    data() {
        return {
            playlist: null,
            chatTab: this.tab
        }
    },
    methods: {
        fetchChartSongs() {
            let route = '/media/chart/music/' + this.chatTab
            axios.get(route).then(response => this.playlist = response);
        },
        getTabClass(tab) {
            if (tab === this.chatTab) {
                return "c-btn-gradient-echo"
            } else return "c-btn-gradient-secondary"
        }
    },
    watch: {
        chatTab() {
            this.playlist = null;
            this.fetchChartSongs()
        }
    }
}
</script>
