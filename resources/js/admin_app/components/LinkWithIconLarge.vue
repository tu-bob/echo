<template>
    <div class="brown-button">
        <router-link class="clean-link" :to="to">
            <b-img class="" center :src="icon"></b-img>
            <h5>
                <slot></slot>
            </h5>
        </router-link>
    </div>
</template>

<script>
export default {
    name: "LinkWithIconLarge",
    props:{
        to:Object,
        icon:String
    }
}
</script>

<style scoped>
.brown-button {
    background-color: #4A4745;
    height: 150px;
    width: 100%;
    border-radius: 10px;
    text-align: center;
    box-shadow: 3px 5px 5px 2px rgba(34, 60, 80, 0.2);
}

.brown-button img {
    width: 110px;
}
.brown-button:hover{
    transform: scale(1.020);
    transition: 0.5s;
}
.clean-link:hover {
    text-decoration: none;
    color: white;
}
</style>
