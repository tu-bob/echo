<template>
    <div class="brown-statistic">
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

<style scoped>
.brown-statistic{
    background-color: #4A4745;
    height: 150px;
    width: 90%;
    border-radius: 10px;
    text-align: center;
    box-shadow: 3px 5px 5px 2px rgba(34, 60, 80, 0.2);
}
.logo-img {
    margin-top: 10px;
    margin-left: 10px;
    width: 120px;
}
.statistic-text{
    padding-top: 30px;
    color: white;
}
.statistic-text h5{
    font-size: 23px;
}
</style>
