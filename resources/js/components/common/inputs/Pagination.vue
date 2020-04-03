<template>
    <div v-if="this.pagination.last_page > 1">
        <div v-if="flow && this.pagination.last_page > currentPage" class="text-center">
            <button @click="currentPage++" class="btn btn-outline-dark">
                Загрузить еще
            </button>
        </div>
        <div v-if="!flow">
            <b-pagination
                v-model="currentPage"
                :total-rows="pagination.total"
                :per-page="pagination.per_page"
            ></b-pagination>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Pagination",
        props: {
            pagination: {
                type: Object,
                required: true
            },
            flow: {
                type: Boolean,
                default: false
            },
        },
        data() {
            return {
                currentPage: this.pagination.current_page
            }
        },
        methods: {
            // pageChange(page) {
            //     if (this.flow)
            //         page = this.currentPage + 1;
            //     if (page !== this.pagination.current_page)
            //         this.onPageChange(page);
            // }
        },
        watch: {
            currentPage() {
                this.$emit('pageChanged', this.currentPage)
            }
        },
        // components: {
        //     'Pagination': require('laravel-vue-pagination')
        // }
    }
</script>

<style scoped>

</style>
