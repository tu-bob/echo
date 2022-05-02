<template>
    <div>
        <b-container fluid>
            <b-row>
                <b-col sm="12" md="5" lg="4" xl="3" style="z-index: 1">
                    <link-with-icon-large icon="/icons/svg/add-album.svg" :to="{name:'a.album.editor'}">Добавить альбом
                    </link-with-icon-large>
                </b-col>

                <b-col sm="12" md="7" lg="8" xl="9" class="filters-form-wrapper">
                    <filters-form class="filters-form-left-intersection" header-text="Поиск альбома" @submit="changeUrl">
                        <b-col sm="12" lg="6" class="my-3 my-lg-0">
                            <input v-model="title" class="filter-input w-100" type="text" placeholder="Имя альбома">
                        </b-col>
                        <b-col sm="12" lg="6">
                            <input v-model="album" class="filter-input w-100" type="text" placeholder="Исполнитель">
                        </b-col>
                    </filters-form>
                </b-col>
            </b-row>
        </b-container>

        <div class="mt-5">
            <albums-table :url="url" class="px-3"></albums-table>
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
    components: {AlbumsTable, SongsTable, FiltersForm, LinkWithIconLarge},
    data () {
        return {
            title: '',
            album: '',
            url: `/media/music/album/list?`
        }
    },
    methods: {
        changeUrl() {
            let url = `/media/music/album/list?`
            if(this.title)
                url+=`filter[title]=${this.title}&`
            if(this.album)
                url +=`filter[artistAliases.name]=${this.album}&`
            this.url = url
        }
    }
}
</script>

