<template>
    <div class="row my-4">
        <div class="col-md-10">
            <label>
                <slot name="header">
                   Выберите файл
                </slot>
            </label>

            <b-form-file
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
                   :src="imageSrc"
                   :blank="!Boolean(imageSrc)"
                   :alt="alt"
            ></b-img>
        </div>
    </div>
</template>

<script>
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
        methods: {
            onChange(e) {
                this.$emit('input', e.target.files[0])
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
