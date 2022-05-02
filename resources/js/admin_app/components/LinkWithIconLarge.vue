<template>
    <div class="link-with-icon-brown">
        <router-link class="hover-text-white" :to="to">
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
