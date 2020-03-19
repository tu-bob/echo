<template>
    <div id="summernote"></div>
</template>

<script>
    import {uploadFiles} from "../../../main";

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
            },
            imageUploadUrl: {
                type: String
            }
        },
        data() {
            return {
                options: {
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
                        ['view', ['fullscreen', 'codeview', 'help']]
                    ]
                }
            }
        },
        mounted() {
            let vue = this;
            this.options.callbacks = {
                onImageUpload: function (files) {
                    console.log(vue.imageUploadUrl)
                    if (!vue.imageUploadUrl)
                        return;
                    uploadFiles(files, vue.imageUploadUrl, 'images').catch(e => console.log(e));
                }
            };
            $('#summernote').summernote(this.options);
        },
    }
</script>

<style scoped>

</style>
