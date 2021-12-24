<template>
    <h1 class="section-header">
        <slot></slot>
    </h1>
</template>

<script>
export default {
    name: "SectionHeader"
}
</script>

<style scoped>
.section-header {
    background-color: #F2F2F2;
    text-align: center;
    font-size: 2rem;
    margin-bottom: 2.5rem;
    padding: 4px 0;
}
</style>
