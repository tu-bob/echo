<template>
    <div class="container-fluid container-lg">
        <div class="row page-header">
            <h1 class="">S. Khalil Production</h1>

        </div>
        <ul class="social-icons mb-4">
            <li class="mr-1">
                <instagram url="https://instagram.com/s.khalil_production?igshid=YmMyMTA2M2Y="
                           title="Следите за новостями исполнителя в инстаграме">
                </instagram>
            </li>
            <li class="mr-1">
                <facebook url="getLink('facebook')"
                          title="Следите за новостями исполнителя на фейсбуке">
                </facebook>
            </li>
            <li class="mr-1">
                <youtube url="https://www.youtube.com/channel/UCjIKCebCtL-UyndOTX_VLbw/about"
                         title="Клипы, влоги и выступления смотрите только на официальном ютуб канале">
                </youtube>
            </li>
        </ul>


        <div class="row no-gutters">
            <div class="col-12 col-md-4 s-item">
                <double-sided-card image-src="/images/skhalil/1.jpg"></double-sided-card>
            </div>
            <div class="col-12 col-md-4 s-item">
                <double-sided-card image-src="/images/skhalil/2.jpg"></double-sided-card>
            </div>
            <div class="col-12 col-md-4 s-item">
                <double-sided-card image-src="/images/skhalil/3.jpg"></double-sided-card>
            </div>
        </div>
        <div class="row no-gutters">
            <div class="col-12 col-md-4 s-item">
                <double-sided-card image-src="/images/skhalil/4.jpg"></double-sided-card>
            </div>
            <div class="col-12 col-md-4 s-item">
                <double-sided-card image-src="/images/skhalil/5.jpg"></double-sided-card>
            </div>
            <div class="col-12 col-md-4 s-item">
                <double-sided-card image-src="/images/skhalil/6.jpg"></double-sided-card>
            </div>
        </div>
        <div class="row no-gutters">
            <div class="col-12 col-md-4 s-item">
                <double-sided-card image-src="/images/skhalil/7.jpg"></double-sided-card>
            </div>
            <div class="col-12 col-md-4 s-item">
                <double-sided-card image-src="/images/skhalil/8.jpg"></double-sided-card>
            </div>
            <div class="col-12 col-md-4 s-item">
                <double-sided-card image-src="/images/skhalil/9.jpg"></double-sided-card>
            </div>
        </div>
        <div class="row no-gutters">
            <div class="col-12 col-md-4 s-item">
                <double-sided-card image-src="/images/skhalil/10.jpg"></double-sided-card>
            </div>
            <div class="col-12 col-md-4 s-item">
                <double-sided-card image-src="/images/skhalil/11.jpg"></double-sided-card>
            </div>
            <div class="col-12 col-md-4 s-item">
                <double-sided-card image-src="/images/skhalil/12.jpg"></double-sided-card>
            </div>
        </div>
    </div>
</template>

<script>
import DoubleSidedCard from "./DoubleSidedCard";
import Instagram from "../../common/external-icons/instagram";
import Facebook from "../../common/external-icons/facebook";
import Youtube from "../../common/external-icons/youtube";
import MetaTagsMixin from "../../admin/mixins/MetaTagsMixin";

export default {
    name: "SKhalil",
    components: {Youtube, Facebook, Instagram, DoubleSidedCard},
    mixins:[MetaTagsMixin],
    data(){
        return{
            title: "S. Khalil Production пожалуй лучшия фотостудия страны"
        }
    }
}
</script>
