<template>
    <table-card :items="videos"
                :fields="fields"
                :url="url"
                :columnsToHide="columnsToHide"
                :paginate="20"
                @dataUpdated="onDataUpdated"
                striped>
        <template #header>
            <slot name="header">
                <span>Список видео</span>
            </slot>
        </template>

        <template v-slot:edit="{item}">
            <a href="#" @click.prevent="$router.push({ name: 'a.video.editor', params: { id: item.id }})">
                <img class="icon-btn-sm" src="/icons/svg/edit.svg">
            </a>
        </template>

        <template v-slot:delete="{item}">
            <delete-entity-icon :url="`/media/video/${item.id}`"
                                @deleted="removeItemFromData(item)"></delete-entity-icon>
        </template>
    </table-card>
</template>

<script>
import TableCard from "../../../components/common/tables/TableCard";
import DeleteEntityIcon from "../../components/DeleteEntityIcon";

export default {
    name: "VideosTable",
    props: {
        columnsToHide: {
            type: Array,
            default: () => []
        },
        data: {
            type: Array,
            default: () => []
        },
        url: {
            type: String,
            default: '/video'
        }
    },
    data() {
        return {
            videos: this.data,
            fields: [
                {
                    key: "title",
                    label: "Название"
                },
                {
                    key: "type",
                    label: "Type"
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
    methods: {
        removeItemFromData(item) {
            this.videos = this.videos.filter( v => v.id !== item.id)
        },
        onDataUpdated(data){
            this.videos = data;
        }
    },
    components: {
        DeleteEntityIcon,
        TableCard
    }
}
</script>

<style scoped>

</style>
