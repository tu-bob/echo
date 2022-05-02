<template>
    <b-aspect aspect="9:16" class="w-100 double-side-card"  >
        <div class="card-side front" :style="stylesObject">

        </div>
        <div class="card-side back">
            <div class="p-5">Здесь скоро будут пасхалки. Ждем-с</div>
        </div>
    </b-aspect>
</template>

<script>
export default {
    name: "DoubleSidedCard",
    props:{
        imageSrc:String
    },
    data(){
        return{
            stylesObject:{
                'background-image': `url(${this.imageSrc})`,
                'background-size': 'cover'
            }
        }
    }
}
</script>

<style scoped>

</style>
