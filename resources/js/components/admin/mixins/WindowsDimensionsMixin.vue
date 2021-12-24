<script>
export default {
    name: "WindowsDimensionsMixin",
    mounted() {
        this.$nextTick(() => {
            window.addEventListener('resize', this.onResize);
        })
    },
    data() {
        return {
            windowWidth: 0,
            windowHeight: 0
        }
    },
    methods:{
        onResize(){
            this.windowHeight = window.innerHeight
            this.windowWidth = window.innerWidth
        }
    }
}
</script>
