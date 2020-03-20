<template>
    <textarea :id="id" :value="value"></textarea>
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
                    uploadFiles(files, vue.imageUploadUrl, 'images')
                        .then(response => {
                            for (let i = 0; i < response.length; i++) {
                                $('#' + vue.id).summernote('insertImage', `/media/image/blog/${response[i].id}`);
                            }
                        })
                        .catch(e => console.log(e));
                },
                onChange: function (article) {
                    vue.$emit('input', article)
                }
            };
            $('#' + this.id).summernote(this.options);
        },
        watch: {
            // value() {
            //     $('#' + this.id).summernote("code", this.value)
            // }
        }
    }
</script>

<style scoped>

</style>
