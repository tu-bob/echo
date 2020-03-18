<script>
    export default {
        name: "TableCardProps",
        props: {
            items: {
                type: Array,
                required: true
            },
            fields: {
                required: true
            },
            setRowClass: {
                type: Function
            },
            tableHeight: {
                type: String
            },
            primaryKey: {
                type: String,
                default: 'id'
            },
            isBusy: {
                type: Boolean,
                default: false
            },
            selectable: {
                type: Boolean,
                default: false
            },
            selectMode: {
                type: String,
                default: 'single'
            },
            striped: {
                type: Boolean,
                default: false
            },
            borderless: {
                type: Boolean,
                default: false
            },
            responsive: {
                type: Boolean,
                default: false
            },
            fixed: {
                type: Boolean,
                default: false
            },
            selectedRowClass: {
                type: String,
                default: 'table-success'
            },
            checkedClass: {
                type: String,
                default: 'text-success'
            },
            hover: {
                type: Boolean,
                default: false
            },
            columnsToHide: {
                type: Array
            }
        },
    }
</script>
