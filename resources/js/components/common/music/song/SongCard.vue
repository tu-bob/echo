<template>
    <div class="container pb-3">
        <div class="row w-100 text-white">
            <b-img class="bg-laravel thumb"
                   :src="thumbnail"
                   rounded
            ></b-img>
            <div class="ml-2 mt-2 row col">
                <div>
                    <h6 class="mb-0">{{song.title}}</h6>
                    <span class="text-muted">{{aliases}} </span>
                </div>
                <div class="ml-auto row">
                    <span>{{duration}}</span>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import {concatStrings, secondsToFormattedMinutes} from '../../../../util/stringHelper'

    export default {
        name: "SongCard",
        props: {
            song: {
                type: Object,
                required: true
            },
            thumbnail: {
                type: String,
                default: 'https://picsum.photos/1024/400/?image=41'
            }
        },
        computed: {
            aliases() {
                return concatStrings(this.song.artistAliases.map(alias => alias.name), ';');
            },
            duration(){
                return secondsToFormattedMinutes(this.song.playtime_seconds)
            }
        }
    }

</script>
<style scoped>
    .thumb {
        object-fit: cover;
        width: 50px !important;
        height: 50px;
    }
</style>
