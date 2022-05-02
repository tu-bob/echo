<template>
    <div class="statistic-btn-brown">
            <b-img left class="logo-img" center :src="icon"></b-img>
               <div class="statistic-text">
                   <h5>
                       <slot></slot>
                   </h5>
                   <h1>{{ count }}</h1>
               </div>
    </div>
</template>

<script>
export default {
    name: "StatisticButton",
    props:{
        icon:String,
        count:0
    }
}
</script>

