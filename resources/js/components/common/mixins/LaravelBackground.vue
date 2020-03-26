<script>
    import {removeLaravelBackground, setLaravelBackground} from "../../../main";

    export default {
        name: "LaravelBackground",
        mounted() {
            setLaravelBackground()
        },
        beforeDestroy() {
            removeLaravelBackground()
        }
    }
</script>
