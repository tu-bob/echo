<template>
    <b-overlay :show="busy" rounded="sm">
        <textarea :id="id"></textarea>
    </b-overlay>
</template>

<script>
    import {generateId, uploadFiles} from "../../../main";

    require('summernote/dist/summernote-bs4.min.js');
    require('summernote/dist/summernote-bs4.min.css');
    require('../summernote/summernote-ru');
    export default {
        name: "Summernote",
        props: {
            value: {
                require: true
            },
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
                id: generateId(),
                busy: false,
                options: {
                    lang: this.lang,
                    height: this.height,
                    minHeight: this.minHeight,
                    focus: true,
                    toolbar: [
                        ['history', ['undo', 'redo']],
                        'style',
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['para', ['ul', 'ol']],
                        'table',
                        ['insert', ['link', 'picture', 'video']],
                        ['view', ['fullscreen', 'help']]
                    ]
                }
            }
        },
        mounted() {
            let vue = this;
            this.options.callbacks = {
                onImageUpload: function (files) {
                    if (!vue.imageUploadUrl)
                        return;
                    vue.busy = true;
                    uploadFiles(files, vue.imageUploadUrl, 'images')
                        .then(response => {
                            for (let i = 0; i < response.length; i++) {
                                $('#' + vue.id).summernote('insertImage', `/media/image/${response[i].id}/blog`);
                            }
                        })
                        .catch(e => console.log(e))
                        .then(_ => vue.busy = false);
                },
                onChange: function (article) {
                    vue.$emit('input', article)
                }
            };
            $('#' + this.id).summernote(this.options);
        },
        methods: {
            innerHtml(data) {
                $('#' + this.id).summernote('code', data);
            }
        }
    }
</script>

<style scoped>

</style>
