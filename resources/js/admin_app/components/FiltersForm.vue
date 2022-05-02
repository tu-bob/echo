<template>
    <form class="filters-form" @submit.capture.prevent="$emit('submit')">
        <span class="text-center  d-none d-lg-block">{{ headerText }}</span>
        <b-row class="mb-3 px-2 px-lg-5">
            <slot></slot>
        </b-row>
        <div class="d-flex">
            <button class="a-btn-black mx-auto">Поиск</button>
        </div>
    </form>
</template>

<script>
export default {
    name: "FiltersForm",
    props: {
        headerText:String,

    }
}
</script>
