<template>
    <div>
        <songs-list :playlist="playlist"></songs-list>
    </div>
</template>

<script>
import SongsList from "../../common/music/song/SongsList";

export default {
    name: "MusicalChartsPage",
    components: {SongsList},
    data() {
        return {
            playlist: []
        }
    },
    methods: {
        fetchChartSongs() {
            axios.get().then(response => this.playlist = data);
        }
    }
}
</script>
