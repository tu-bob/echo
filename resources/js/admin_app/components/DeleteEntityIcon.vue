<template>
    <div>
        <button class="transparent-btn" @click="confirm">
            <img class="icon-btn-sm" src="/icons/svg/delete.svg">
        </button>

        <b-modal ref="delete" hide-footer title="Удаление">
            <div class="d-block text-center">
                <h3>Вы уверены что хотите удалить!</h3>
            </div>
            <b-button class="mt-3" variant="outline-danger" block @click="destroy">Удалить</b-button>
        </b-modal>
    </div>
</template>

<script>
export default {
    name: "DeleteEntityIcon",
    props: {
        url: String
    },
    methods: {
        confirm() {
            this.$refs['delete'].show()
        },
        destroy() {
            this.$refs['delete'].hide();
            axios.delete(this.url).then(_ => this.$emit('deleted'));
        }
    }
}
</script>

<style scoped>

</style>
