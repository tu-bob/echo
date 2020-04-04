<template>
    <carousel :nav="false" :dots="false" :responsive="{0:{items:1},540:{items:2},720:{items:3},1200:{items:4}}">
        <div v-for="item in items">
            <song-card v-for="song in item" :song="song" :key="song.id"></song-card>
        </div>
    </carousel>
</template>

<script>
    import SongCard from "./SongCard";
    import Carousel from 'vue-owl-carousel'

    export default {
        name: "SongsCarousel",
        components: {SongCard, Carousel},
        props: {
            songs: {
                type: Array,
                required: true
            }
        },
        watch: {
            songs() {
                console.log(this.songs, 'songs')
            }
        },
        computed: {
            items() {
                let items = [];
                for (let i = 0; i < this.songs.length; i++) {
                    let index = Math.floor(i / 4);
                    if (!items[index])
                        items[index] = [];
                    items[index].push(this.songs[i]);
                }
                console.log(items);
                return items;
            }
        }

    }
</script>

<style scoped>

</style>
