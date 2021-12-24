<template>
    <form class="filters-form">
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

<style scoped>
span{
    font-size: 21px;
    padding: 10px 0;
}
.filters-form {
    background-color: #EEF1F4;
    border-radius: 10px;
    height: 150px;
}

.filter-input {
    background-color: white;
    height: 30px;
    border: none;
    border-radius: 5px;
}

::placeholder {
    color: #C4C4C4;
    padding-left: 10px;
}



.a-btn-black {
    background: #4A4745;
    color: white;
    padding: 4px 48px;
    border: none;
}
.a-btn-black:hover{
    transform: scale(1.020);
    transition: 0.5s;
}
</style>
