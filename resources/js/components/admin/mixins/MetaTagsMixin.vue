<script>
    import {mapGetters} from "vuex";

    export default {
        name: "MetaTagsMixin",
        data(){
            return{
                defaultDescription: 'Музыкально-информационный портал Echo.tj. Песни, альбомы, видео, новости,' +
                    ' статьи и многое другое в удобном приложении. Слушайте музыку онлайн, скачивайте на устройства, ' +
                    'находите тексты песен и аккорды таджикских артистов'
            }
        },
        created() {
            this.updateTitle();
            this.updateDescription();
        },
        methods: {
            updateTitle() {
                if (!this.ACTIVE_SONG) {
                    const title = this.getTitle(this);
                    document.title = title ? title : 'Echo.tj - Музыкальное наследие Таджикистана'
                }
            },
            updateDescription() {
                let desc = this.getDescription(this);
                if(!desc)
                    desc = this.defaultDescription;
                $('meta[name=description]').remove();
                $('head').append( '<meta name="description" content="'+ desc +'">' );
            },
            getTitle() {
                if (this.title) {
                    return typeof this.title === 'function'
                        ? this.title.call()
                        : this.title
                }
            },
            getDescription() {
                if (this.description) {
                    return typeof this.description === 'function'
                        ? this.description.call()
                        : this.description
                }
            }
        },
        computed: {
            ...mapGetters([
                'ACTIVE_SONG'
            ])
        }
    }
</script>
