<template>
    <div>
        <table-card :items="users"
                    :fields="fields"
                    :url="url"
                    :columnsToHide="columnsToHide"
                    :paginate="20"
                    striped>
            <template #header>
                <slot name="header">
                    <span>Список пользователей</span>
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
import TableCard from "../../../components/common/tables/TableCard";

export default {
    name: "UsersTable",
    created() {
    },
    props: {
        columnsToHide: {
            type: Array,
            default: () => ['delete']
        },
        providedUsers: {
            type: Array,
            default: () => []
        },
        url: {
            type: String,
            default: '/users?'
        }
    },
    data() {
        return {
            users: this.providedUsers,
            fields: [
                {
                    key: "name",
                    label: "Имя"
                },
                {
                    key: "email",
                    label: "Email"
                }
            ]
        }
    },
    watch: {
        providedUsers() {
            this.songs = this.providedUsers;
        }
    },
    components: {
        TableCard
    },
}
</script>

<style scoped>

</style>
