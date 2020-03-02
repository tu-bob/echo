<template>
    <div id="summernote" name="editordata"></div>
</template>

<script>
    require('summernote/dist/summernote-bs4.min.js');
    require('summernote/dist/summernote-bs4.min.css');
    require('../summernote/summernote-ru');
    export default {
        name: "Summernote",
        props: {
            lang: {
                type: String,
                default: 'ru-RU'
            },
            height: {
                default: null
            },
            minHeight: {
                default: '60vh'
            }
        },
        mounted() {
            $('#summernote').summernote({
                lang: this.lang,
                height: this.height,
                minHeight: this.minHeight,
                focus: true,
                toolbar: [
                    ['history', ['undo', 'redo']],
                    'style',
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    'table',
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                ]
            });
        },
    }
</script>

<style scoped>

</style>
