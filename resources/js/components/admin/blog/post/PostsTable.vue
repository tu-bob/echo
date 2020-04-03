<template>
    <div>
        <table-card :items="posts"
                    :fields="fields"
                    :url="url"
                    :columnsToHide="columnsToHide"
                    :paginate="20">
            <template #header>
                <slot name="header">
                    <span>Посты</span>
                </slot>
            </template>

            <template v-slot:edit="{item}">
                <a href="#" @click.prevent="$router.push({ name: 'post-editor', params: { id: item.id }})">
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
        name: "PostsTable",
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
                default: '/blog/post/list'
            }
        },
        data() {
            return {
                posts: this.data,
                fields: [
                    {
                        key: "title",
                        label: "Заголовок"
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
                this.posts = this.data;
            }
        },
        components: {
            TableCard
        }
    }
</script>

<style scoped>

</style>
