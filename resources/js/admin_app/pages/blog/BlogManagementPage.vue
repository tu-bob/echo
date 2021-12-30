<template>
    <div>
        <b-container fluid>
            <b-row>
                <b-col sm="12" md="5" lg="4" xl="3" style="z-index: 1">
                    <link-with-icon-large icon="/icons/svg/add-album.svg" :to="{name:'a.post.editor'}">Добавить статью
                    </link-with-icon-large>
                </b-col>

                <b-col sm="12" md="7" lg="8" xl="9" class="filters-form-wrapper">
                    <filters-form header-text="Поиск статьи" @submit="changeUrl">
                        <b-col sm="12" lg="6" class="my-3 my-lg-0">
                            <input v-model="title" class="filter-input w-100" type="text" placeholder="Имя статьи">
                        </b-col>
                        <b-col sm="12" lg="6">
                            <input v-model="author" class="filter-input w-100" type="text" placeholder="Автор статьи">
                        </b-col>
                    </filters-form>
                </b-col>
            </b-row>
        </b-container>

        <div class="mt-5">
            <posts-table :url="url" class="px-3"></posts-table>
        </div>
    </div>


</template>

<script>
import SectionHeader from "../../components/SectionHeader";
import LinkWithIconLarge from "../../components/LinkWithIconLarge";
import FiltersForm from "../../components/FiltersForm";
import PostsTable from "./PostsTable";
export default {
    name: "BlogManagementPage",
    components: {PostsTable, FiltersForm, LinkWithIconLarge, SectionHeader},
    data () {
        return {
            title: '',
            author: '',
            url: `/blog/post/list?`
        }
    },
    methods: {
        changeUrl() {
            let url = `/blog/post/list?`
            if(this.title)
                url+=`filter[title]=${this.title}&`
            if(this.author)
                url +=`filter[author.name]=${this.author}&`
            this.url = url
        }
    }
}
</script>

<style scoped>
.filters-form{
    padding-left: 10px;
    margin-left: -40px;
}

@media only screen and (max-width: 767px) {
    .filters-form {
        padding-left: 0;
        margin-left: 0;
    }
}
</style>
