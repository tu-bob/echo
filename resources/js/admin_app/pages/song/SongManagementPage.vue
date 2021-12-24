<template>
    <div>
        <b-container fluid>
            <b-row>
                <b-col sm="12" md="5" lg="4" xl="3" style="z-index: 1">
                    <link-with-icon-large icon="/icons/svg/add-album.svg" :to="{name:'a.song.editor'}">Добавить песню
                    </link-with-icon-large>
                </b-col>

                <b-col sm="12" md="7" lg="8" xl="9" class="filters-form-wrapper">
                    <filters-form header-text="Поиск песни">
                        <b-col sm="12" lg="6" class="my-3 my-lg-0">
                            <input class="filter-input w-100" type="text" placeholder="Имя песни">
                        </b-col>
                        <b-col sm="12" lg="6">
                            <input class="filter-input w-100" type="text" placeholder="Автор песни">
                        </b-col>
                    </filters-form>
                </b-col>
            </b-row>
        </b-container>

        <div class="mt-5">
            <songs-table class="px-3"></songs-table>
        </div>
    </div>
</template>

<script>
import SongsTable from "./SongsTable";
import LinkWithIconLarge from "../../components/LinkWithIconLarge";
import FiltersForm from "../../components/FiltersForm";

export default {
    name: "SongManagementPage",
    components: {FiltersForm, LinkWithIconLarge, SongsTable}
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
