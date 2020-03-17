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

            <template v-slot:edit="{item}">
                <a :href="`/app/media/song/${item.id}`"><img class="icon-btn-sm" src="/icons/svg/edit.svg"></a>
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
                    },
                    {
                        key: "edit",
                        label: ""
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
