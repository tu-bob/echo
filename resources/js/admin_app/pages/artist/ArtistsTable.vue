<template>
    <table-card :items="artists"
                :fields="fields"
                :url="url"
                :columnsToHide="columnsToHide"
                :paginate="20"
                striped>
        <template #header>
            <slot name="header">
                <span>Список исполнителей</span>
            </slot>
        </template>

        <template v-slot:aliases="{item}">
            <span v-for="alias in item.aliases">{{alias.name}}; </span>
        </template>

        <template v-slot:edit="{item}">
            <a href="#" @click.prevent="$router.push({ name: 'artist-editor', params: { id: item.id }})">
                <img class="icon-btn-sm" src="/icons/svg/edit.svg">
            </a>
        </template>

        <template v-slot:delete="{item}">
            <slot name="delete" v-bind:song="item">
                --
            </slot>
        </template>
    </table-card>
</template>

<script>
    import TableCard from "../../../components/common/tables/TableCard";

    export default {
        name: "ArtistsTable",
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
                default: '/media/artist/list?order=latest&'
            }
        },
        data() {
            return {
                artists: this.data,
                fields: [
                    {
                        key: "aliases",
                        label: "Имена"
                    },
                    {
                        key: "edit",
                        label: ""
                    },
                    {
                        key: "delete",
                        label: ""
                    },
                ]
            }
        },
        watch: {
            data() {
                this.artists = this.data;
            }
        },
        components: {
            TableCard
        }
    }
</script>

<style scoped>

</style>
