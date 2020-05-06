<script>
    export default {
        name: "AxiosCancellationMixin",
        data() {
            return {
                cancelTokenSource: axios.CancelToken.source()
            }
        },
        methods: {
            getCancellationToken() {
                return this.cancelTokenSource.token;
            },
            cancel(){
                this.cancelTokenSource.cancel();
            }
        },
        beforeDestroy() {
            if (this.cancelTokenSource) {
                this.cancel();
            }
        },
    }
</script>
