<template>
    <div>

        <b-container fluid>
            <b-row>
                <b-col sm="12" md="5" lg="4" xl="3" style="z-index: 1">
                    <link-with-icon-large icon="/icons/svg/add-video.svg" :to="{name:'a.video.editor'}">Добавить видео
                    </link-with-icon-large>
                </b-col>

                <b-col sm="12" md="7" lg="8" xl="9" class="filters-form-wrapper">
                    <filters-form header-text="Поиск видео" @submit="changeUrl">
                        <b-col sm="12" class="my-3 my-lg-0">
                            <input v-model="artist" class="filter-input w-100" type="text" placeholder="Название">
                        </b-col>
                    </filters-form>
                </b-col>
            </b-row>
        </b-container>

        <div class="mt-5">
<!--            <artists-table :url="url" class="px-3"></artists-table>-->
        </div>
    </div>
</template>

<script>
import LinkWithIconLarge from "../../components/LinkWithIconLarge";
import FiltersForm from "../../components/FiltersForm";
export default {
    name: "VideoManagementPage",
    components: {FiltersForm, LinkWithIconLarge},
    data () {
        return {
            title: '',
            url: `/blog/post/list?`
        }
    },
    methods: {
        changeUrl() {
            let url = `/blog/post/list?`
            if(this.title)
                url+=`filter[title]=${this.title}&`
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
