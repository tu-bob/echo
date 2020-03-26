<script>
    import {removeLaravelTheme, setLaravelTheme} from "../../../main";

    export default {
        name: "LaravelBackground",
        mounted() {
            setLaravelTheme()
        },
        beforeDestroy() {
            removeLaravelTheme()
        }
    }
</script>
