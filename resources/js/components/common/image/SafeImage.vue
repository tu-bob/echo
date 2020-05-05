<template>
    <img :src="safeSrc" @error="onImageError">
</template>

<script>
    import InaccessibleResourceMixin from "../mixins/InaccessibleResourceMixin";

    export default {
        name: "SafeImage",
        mixins: [InaccessibleResourceMixin],
        props: {
            src: String,
            fallbackSrc: String
        },
        methods: {
            onImageError(e) {
                this.cacheInaccessibleResource(this.src);
                e.target.src = this.fallbackSrc;
                $(e.target).addClass('p-1');
            },
        },
        computed: {
            safeSrc() {
                if (this.isResourceInaccessible(this.src))
                    return this.fallbackSrc;
                return this.src;
            }
        }
    }
</script>
