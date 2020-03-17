<template>
    <div>
        <table-card :items="songs"
                    :fields="fields">
            <template #header>
                <span>Список загруженных песен</span>
            </template>

            <template v-slot:artistAliases="{item}">
                <span v-for="alias in item.artistAliases">{{alias.name}};</span>
            </template>
        </table-card>
    </div>
</template>

<script>
    import TableCard from "../../common/tables/TableCard";

    export default {
        name: "SongsTable",
        created() {
            this.fetchSongs();
        },
        data() {
            return {
                songs: [],
                fields: [
                    {
                        key: "title",
                        label: "Название"
                    },
                    {
                        key: "year",
                        label: "Год"
                    },
                    {
                        key: "label",
                        label: "Лейбл"
                    },
                    {
                        key: "artistAliases",
                        label: "Исполнители"
                    }
                ]
            }
        },
        methods: {
            fetchSongs() {
                axios.get('/media/music/song/list')
                    .then(songs => this.songs = songs)
                    .catch();
            }
        },
        components: {
            TableCard
        }
        ,
    }
</script>

<style scoped>

</style>
