<template>
    <div class="card">
        <div class="card-header">
            <div class="row align-items-baseline">
                <slot name="header">

                </slot>
            </div>
        </div>

        <b-table :borderless="borderless"
                 :busy="isBusy"
                 :fields="tableFields"
                 :fixed="fixed"
                 :items="tableItems"
                 :primary-key="primaryKey"
                 :responsive="responsive"
                 :select-mode="selectMode"
                 :selectable="selectable"
                 :striped="striped"
                 :hover="hover"
                 small>

            <template v-slot:table-busy>
                <div class="text-center text-info my-2">
                    <b-spinner class="align-middle"></b-spinner>
                </div>
            </template>

            <!--            <template slot="selected" slot-scope="data">-->
            <!--                <span :class="checkedClass" v-if="isSelected(data.item)">-->
            <!--                    <slot name="selectedCell">&check;</slot>-->
            <!--                </span>-->
            <!--                <span v-else>-->
            <!--                    <slot name="notSelectedCell"></slot>-->
            <!--                </span>-->
            <!--            </template>-->

            <!--            <template :slot="cell" slot-scope="data" v-for="cell in customCells">-->
            <!--                <slot :name="cell" v-bind:item="data.item"></slot>-->
            <!--            </template>-->

            <!--                        <template v-slot:[cell] v-for="cell in customCells">-->
            <!--                            2-->
            <!--                        </template>-->

            <template v-for="(_, key) of $scopedSlots" v-slot:[concatCellKey(key)]="data">
                <slot :name="key" v-bind="data"/>
            </template>

            <!--            <template v-for="cell in customCells" :slot="cell" slot-scope="data">-->
            <!--                <slot :name="cell" v-bind:item="data.item"></slot>-->
            <!--            </template>-->
            <!--            <template v-slot:[concatCellKey(cell)]="data" v-for="cell in customCells">-->
            <!--                2-->
            <!--            </template>-->
        </b-table>
        <div class="card-footer">
            <slot name="footer">
                <pagination v-if="paginate && pagination" :pagination="pagination" @pageChanged="fetch"></pagination>
            </slot>
        </div>
    </div>
</template>

<script>
    import TableCardProps from './TableCardProps.vue'
    import Pagination from "../inputs/Pagination";

    export default {

        name: "TableCard",
        components: {Pagination},
        mixins: [TableCardProps],
        mounted() {
            if (this.columnsToHide)
                this.hideColumns();
            if (this.url)
                this.fetch()
        },
        data() {
            return {
                tableFields: this.fields,
                tableItems: this.items,
                pagination: null
                // selected: [],
                // selectAll: false
            }
        },
        methods: {
            // onRowClick(item) {
            //     if (!this.selectable)
            //         return;
            //     if (this.isSelected(item)) {
            //         this.selected = this.selected.filter(function (stored) {
            //             return stored.id !== item.id
            //         })
            //     } else {
            //         this.selected.push(item)
            //     }
            //
            //     return this.$emit('itemsSelected', this.selected);
            // },
            // isSelected(item) {
            //     return this.selected.find(function (selected) {
            //         return selected.id === item.id;
            //     });
            // },
            // rowClass(item, type) {
            //     if (!item) return;
            //     if (this.isSelected(item)) return this.selectedRowClass
            // },
            concatCellKey(key) {
                return `cell(${key})`;
            },
            hideColumns() {
                for (let i = 0; i < this.columnsToHide.length; i++) {
                    this.tableFields = this.tableFields.filter(field =>
                        field.key !== this.columnsToHide[i]
                    )
                }
            },
            async fetch(page = null) {
                if (this.url)
                    await axios.get(this.prepareUrl(page))
                        .then(response => {
                            if (this.paginate) {
                                this.pagination = response;
                                this.tableItems = response.data;
                            } else this.tableItems = response
                        })
                        .catch();
            },
            prepareUrl(page) {
                let url = this.url;
                if (this.paginate) {
                    page = page ? page : 1;
                    url += `paginate=${this.paginate}&page=${page}`;
                }
                return url;
            }
        },
        watch: {
            // selectAll() {
            //     if (this.selectAll) {
            //         this.selected = this.items;
            //     } else this.selected = [];
            //
            //     return this.$emit('itemsSelected', this.selected);
            // },
            items() {
                this.tableItems = this.items;
            },
            fields() {
                this.tableFields = this.fields;
            },
            columnsToHide() {
                this.hideColumns();
            },
            url(){
                console.log('url changed')
                this.pagination = null
                this.fetch()
            }
        },
    }
</script>
