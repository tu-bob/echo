<template>
    <div>
        <b-container fluid>
            <b-row>
                <b-col sm="12" md="5" lg="4" xl="3" style="z-index: 1">
                    <link-with-icon-large icon="/icons/svg/add-user.svg" :to="{name:'a.artist.editor'}">Добавить
                        исполнителя
                    </link-with-icon-large>
                </b-col>

                <b-col sm="12" md="7" lg="8" xl="9" class="filters-form-wrapper">
                    <filters-form class="filters-form-left-intersection" header-text="Поиск исполнителя" @submit="changeUrl">
                        <b-col sm="12" class="my-3 my-lg-0">
                            <input v-model="artist" class="filter-input w-100" type="text"
                                   placeholder="Имя исполнителя">
                        </b-col>
                    </filters-form>
                </b-col>
            </b-row>
        </b-container>

        <div class="mt-5">
            <artists-table :url="url" class="px-3"></artists-table>
        </div>
    </div>
</template>

<script>
import LinkWithIconLarge from "../../components/LinkWithIconLarge";
import FiltersForm from "../../components/FiltersForm";
import ArtistsTable from "./ArtistsTable";
import AlbumsTable from "../album/AlbumsTable";

export default {
    name: "ArtistManagementPage",
    components: {AlbumsTable, ArtistsTable, FiltersForm, LinkWithIconLarge},
    data() {
        return {
            artist: '',
            url: `/media/artist/list?`
        }
    },
    methods: {
        changeUrl() {
            let url = `/media/artist/list?`
            if (this.artist)
                url += `filter[aliases.name]=${this.artist}&`
            this.url = url
        }
    }
}
</script>
