<template>
    <b-container fluid="md" v-if="artist">
        <div class="d-flex flex-wrap mb-5">
            <b-avatar size="200px"
                      class="mr-5"
                      src="https://is5-ssl.mzstatic.com/image/thumb/Music/0e/98/0e/mzi.izbblfhm.tif/190x190cc.jpg"></b-avatar>

            <div>
                <h1 class="typography-header-emphasized text-white">{{artist.aliases[0].name}}</h1>
                <h2 class="typography-title text-secondary">{{aliases}}</h2>
            </div>
        </div>
        <div>
            <h2 class="typography-title text-secondary mt-5 mb-4">Альбомы</h2>
            <div class="d-flex flex-wrap justify-content-start">
                <album-card class="mb-4 mr-4"
                            style="width: 350px"
                            v-for="album in artist.albums"
                            :key="album.id"
                            :album="album">
                </album-card>
            </div>
        </div>
        <div>
            <h2 class="typography-title text-secondary mt-5 mb-4">Песни</h2>
            <div class="row">
                <songs-list :playlist="artist.songs.slice(0, Math.ceil(artist.songs.length/2))"
                            no-fetch
                            :class="{'col-md-6':artist.songs.length > 1, 'col-12':artist.songs.length < 2}"
                            ></songs-list>
                <songs-list :playlist="artist.songs.slice(Math.ceil(artist.songs.length/2))"
                            no-fetch
                            class="col-md-6"></songs-list>
            </div>
        </div>
    </b-container>
</template>

<script>
    import {concatStrings} from "../../../util/stringHelper";
    import AlbumCard from "../../common/music/album/AlbumCard";
    import SongsList from "../../common/music/song/SongsList";

    export default {
        name: "ArtistView",
        props: {
            id: null
        },
        components: {SongsList, AlbumCard},
        data() {
            return {
                artist: null
            }
        },
        mounted() {
            this.fetchArtist();
        },
        methods: {
            fetchArtist() {
                axios.get('/media/alias-artist/' + this.id)
                    .then(artist => this.artist = artist)
            }
        },
        computed: {
            aliases() {
                return concatStrings(this.artist.aliases.slice(1, this.artist.aliases.length).map(alias => alias.name), ' ·');
            }
        }
    }
</script>

<style scoped>

</style>
