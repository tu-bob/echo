<template>
    <b-img :src="safeSrc" @error="onImageError" :blankColor="blankColor" :blank="blank" :rounded="rounded"></b-img>
</template>

<script>
    import InaccessibleResourceMixin from "../mixins/InaccessibleResourceMixin";

    export default {
        name: "SafeImage",
        mixins: [InaccessibleResourceMixin],
        props: {
            src: String,
            fallbackSrc: String,
            blankColor: {
                type: String,
                default: "#a892f8cf"
            },
            fallbackBlank: Boolean,
            rounded: Boolean,
        },
        data() {
            return {
                blank: false
            }
        },
        methods: {
            onImageError(e) {
                this.cacheInaccessibleResource(this.src);
                if (this.fallbackBlank)
                    this.blank = true;
                else {
                    e.target.src = this.fallbackSrc;
                    $(e.target).addClass('p-1');
                }
            },
        },
        computed: {
            safeSrc() {
                if (this.isResourceInaccessible(this.src)) {
                    if (this.fallbackBlank) {
                        this.blank = true;
                        return
                    } else return this.fallbackSrc;
                }
                return this.src;
            }
        }
    }
</script>
