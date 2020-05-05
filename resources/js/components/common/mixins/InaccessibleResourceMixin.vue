<script>
    export default {
        name: "InaccessibleResourceMixin",
        methods: {
            cacheInaccessibleResource(resource) {
                this.$store.commit('ADD_INACCESSIBLE_RESOURCE', resource);
            },
            isResourceInaccessible(resource){
                return this.$store.getters.IS_RESOURCE_INACCESSIBLE(resource)
            }
        }
    }
</script>
