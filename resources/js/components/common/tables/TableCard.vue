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
                 :fields="fields"
                 :fixed="fixed"
                 :items="items"
                 :primary-key="primaryKey"
                 :responsive="responsive"
                 :select-mode="selectMode"
                 :selectable="selectable"
                 :striped="striped"
                 :hover="hover"
                 :tbody-tr-class="setRowClass? setRowClass:rowClass"
                 small
                 @row-clicked="onRowClick">

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

        <slot name="footer">

        </slot>
    </div>
</template>

<script>
    import TableCardProps from './TableCardProps.vue'

    export default {

        name: "TableCard",
        mixins: [TableCardProps],
        mounted() {
            console.log(this);
            for (let i = 0; i < this.$parent.$slots; i++) {
                console.log(this.$parent.$slots[i])
            }

            for (let i = 0; i < this.$parent.$scopedSlots; i++) {
                console.log(this.$parent.$scopedSlots[i])
            }
        },
        props: {
            customCells: {
                type: Array,
                default: () => ['artistAliases']
            }
        },
        methods: {
            onRowClick(item) {
                if (!this.selectable)
                    return;
                if (this.isSelected(item)) {
                    this.selected = this.selected.filter(function (stored) {
                        return stored.id !== item.id
                    })
                } else {
                    this.selected.push(item)
                }

                return this.$emit('itemsSelected', this.selected);
            },
            isSelected(item) {
                return this.selected.find(function (selected) {
                    return selected.id === item.id;
                });
            },
            rowClass(item, type) {
                if (!item) return;
                if (this.isSelected(item)) return this.selectedRowClass
            },
            concatCellKey(key) {
                return `cell(${key})`;
            },
            show(slot) {
                console.log(slot)
                return 2;
            }
        },
        watch: {
            selectAll() {
                if (this.selectAll) {
                    this.selected = this.items;
                } else this.selected = [];

                return this.$emit('itemsSelected', this.selected);
            }
        },
        data() {
            return {
                selected: [],
                selectAll: false
            }
        },
    }
</script>
