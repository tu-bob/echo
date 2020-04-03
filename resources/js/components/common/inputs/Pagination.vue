<template>
    <div v-if="this.pagination.last_page > 1">
        <b-overlay v-if="flow"
                   :show="loading"
                   rounded="md"
                   spinner-variant="light"
                   opacity="0"
                   blur="none">
            <div v-if="this.pagination.last_page > currentPage && !loading" class="text-center">
                <button @click="loadMoreBtnClick" class="btn btn-outline-dark">
                    Загрузить еще
                </button>
            </div>
        </b-overlay>
        <div v-if="!flow">
            <b-pagination
                last-number
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
                currentPage: this.pagination.current_page,
                loading: false
            }
        },
        methods: {
            loadMoreBtnClick() {
                if (!this.loading) {
                    this.currentPage++;
                    this.loading = true;
                }
            },
            loaded(){
                this.loading = false;
            }
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
