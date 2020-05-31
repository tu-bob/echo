<template>
    <div>
        <table-card :items="songs"
                    :fields="fields"
                    :url="url"
                    :columnsToHide="columnsToHide"
                    :paginate="20"
                    striped>
            <template #header>
                <slot name="header">
                    <span>Список загруженных песен</span>
                </slot>
            </template>

            <template v-slot:artistAliases="{item}">
                <span v-for="alias in item.artistAliases">{{alias.name}};</span>
            </template>

            <template v-slot:edit="{item}">
                <a href="#" @click.prevent="$router.push({ name: 'song-editor', params: { id: item.id }})">
                    <img class="icon-btn-sm" src="/icons/svg/edit.svg">
                </a>
            </template>

            <template v-slot:delete="{item}">
                <slot name="delete" v-bind:song="item">
                    --
                </slot>
            </template>
        </table-card>
    </div>
</template>

<script>
    import TableCard from "../../../common/tables/TableCard";

    export default {
        name: "SongsTable",
        created() {
        },
        props: {
            columnsToHide: {
                type: Array,
                default: () => ['delete']
            },
            providedSongs: {
                type: Array,
                default: () => []
            },
            url: {
                type: String,
                default: '/media/music/song/list?order=latest&'
            }
        },
        data() {
            return {
                songs: this.providedSongs,
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
                    },
                    {
                        key: "delete",
                        label: ""
                    }
                ]
            }
        },
        watch: {
            providedSongs() {
                this.songs = this.providedSongs;
            }
        },
        components: {
            TableCard
        },
    }
</script>

<style scoped>

</style>
