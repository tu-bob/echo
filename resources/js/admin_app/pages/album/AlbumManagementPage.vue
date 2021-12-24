<template>
    <div>
        <b-container fluid>
            <b-row>
                <b-col sm="12" md="5" lg="4" xl="3" style="z-index: 1">
                    <link-with-icon-large icon="/icons/svg/add-album.svg" :to="{name:'a.album.editor'}">Добавить альбом
                    </link-with-icon-large>
                </b-col>

                <b-col sm="12" md="7" lg="8" xl="9" class="filters-form-wrapper">
                    <filters-form header-text="Поиск альбома">
                        <b-col sm="12" lg="6" class="my-3 my-lg-0">
                            <input class="filter-input w-100" type="text" placeholder="Имя альбома">
                        </b-col>
                        <b-col sm="12" lg="6">
                            <input class="filter-input w-100" type="text" placeholder="Исполнитель">
                        </b-col>
                    </filters-form>
                </b-col>
            </b-row>
        </b-container>

        <div class="mt-5">
            <albums-table class="px-3"></albums-table>
        </div>
    </div>
</template>

<script>
import LinkWithIconLarge from "../../components/LinkWithIconLarge";
import FiltersForm from "../../components/FiltersForm";
import SongsTable from "../song/SongsTable";
import AlbumsTable from "./AlbumsTable";

export default {
    name: "AlbumManagementPage",
    components: {AlbumsTable, SongsTable, FiltersForm, LinkWithIconLarge}
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
