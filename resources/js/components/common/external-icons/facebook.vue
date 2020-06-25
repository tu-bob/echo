<template>
    <a :href="url" target="_blank" :aria-label="title" :title="title">
        <svg xmlns="http://www.w3.org/2000/svg" class="social-icon" version="1.1"
             x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;"
             xml:space="preserve">
<path
    d="M384,176h-96v-64c0-17.664,14.336-32,32-32h32V0h-64l0,0c-53.024,0-96,42.976-96,96v80h-64v80h64v256  h96V256h64L384,176z"/>
            <g>
</g>
            <g>
</g>
            <g>
</g>
            <g>
</g>
            <g>
</g>
            <g>
</g>
            <g>
</g>
            <g>
</g>
            <g>
</g>
            <g>
</g>
            <g>
</g>
            <g>
</g>
            <g>
</g>
            <g>
</g>
            <g>
</g>
</svg>
    </a>
</template>

<script>
    export default {
        name: "facebook",
        props: {
            url: {
                type: String,
                required: true
            },
            title: null
        }
    }
</script>

<style scoped>

</style>
