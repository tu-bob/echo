<template>
    <div class="row my-4">
        <div class="col-md-10">
            <label>
                <slot name="header">
                    Выберите файл
                </slot>
            </label>

            <b-form-file
                :ref="id"
                v-bind:value="value"
                v-on:change="onChange"
                :state="Boolean(src) || Boolean(value)"
                accept="image/jpeg, image/png"
                placeholder="Выберите картинку или перетащите ее сюда..."
                drop-placeholder="Перетащите обложку сюда..."
                browse-text="Обзор"
            ></b-form-file>
        </div>
        <div class="col-md-2 my-3 my-md-0">
            <b-img thumbnail
                   fluid
                   width="100"
                   height="100"
                   class="bg-laravel"
                   :src="imageSrc"
                   :blank="!Boolean(imageSrc) || forceBlank"
                   :alt="alt"
                   @error="onImageLoadError"
            ></b-img>
        </div>
    </div>
</template>

<script>
    import {generateId} from "../../../main";

    export default {
        name: "ImageUploader",
        props: {
            value: {
                default: null
            },
            src: {
                type: String,
                default: null
            },
            alt: {
                default: 'Картинка echo.tj'
            }
        },
        data() {
            return {
                forceBlank: false,
                id:generateId()
            }
        },
        methods: {
            onChange(e) {
                this.$emit('input', e.target.files[0])
            },
            onImageLoadError() {
                this.forceBlank = true;
            },
            reset() {
                this.$refs[this.id].reset();
            }
        },
        computed: {
            imageSrc() {
                if (this.value) {
                    return URL.createObjectURL(this.value);
                } else if (this.src)
                    return this.src;
            }
        }
    }
</script>

<style scoped>

</style>
