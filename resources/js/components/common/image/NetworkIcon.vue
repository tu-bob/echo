<template>
    <div class="icon-wrapper">
        <a href="url">
            <slot style="">

            </slot>
        </a>
    </div>
</template>

<script>
    export default {
        name: "NetworkIcon",
        props: {
            url: String
        }
    }
</script>

<style scoped>
    .icon-wrapper {
        width: 54px;
        height: 54px;
    }

    .network-icon {
        width: 24px;
        height: 24px;
    }
</style>
