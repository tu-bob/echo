<template>
    <div>
        <table-card :items="albums"
                    :fields="fields"
                    :url="url"
                    :columnsToHide="columnsToHide"
                    :paginate="20"
                    striped>
            <template #header>
                <slot name="header">
                    <span>Список альбомов</span>
                </slot>
            </template>

            <template v-slot:edit="{item}">
                <a href="#" @click.prevent="$router.push({ name: 'album-editor', params: { id: item.id }})">
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
        name: "AlbumsTable",
        created() {
        },
        props: {
            columnsToHide: {
                type: Array,
                default: () => ['delete']
            },
            data: {
                type: Array,
                default: () => []
            },
            url: {
                type: String,
                default: '/media/music/album/list?order=latest&'
            }
        },
        data() {
            return {
                albums: this.data,
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
            data() {
                this.albums = this.data;
            }
        },
        components: {
            TableCard
        }
    }
</script>

<style scoped>

</style>
