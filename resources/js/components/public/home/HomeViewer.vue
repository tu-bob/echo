<template>
    <b-container fluid>
        <div id="horizontal-nav" class="horizontal-nav-wrapper">
            <ul class="horizontal-scroll-list m-0 p-0 moving-border">
                <b-nav-item class="horizontal-nav-menu-item m-item" :to="{name:'overview'}" exact
                            exact-active-class="active">
                <span class="menu-icon pr-md-3">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 15"><defs></defs><g><g
                        id="overviews_icon" class="cls-1"><g
                        id="overviews_icon-2">
                        <path class="cls-2"
                              d="M16,1.4A1.43,1.43,0,0,0,14.55,0l-8,.7a1.43,1.43,0,0,0-1.45,1.4v7h0v2.78h0a2,2,0,0,1,0,.38,2.14,2.14,0,0,1-2.19,2.09,2.1,2.1,0,1,1,0-4.19,2.25,2.25,0,0,1,.72.13v-.13h0a.34.34,0,0,0,0-.69h0a.33.33,0,0,0-.18.06,2.75,2.75,0,0,0-.54-.06A2.85,2.85,0,0,0,0,12.22,2.85,2.85,0,0,0,2.91,15a2.85,2.85,0,0,0,2.91-2.78s0,0,0-.06h0V2.09a.71.71,0,0,1,.73-.7l8-.7a.71.71,0,0,1,.73.7v7h0v2.78h0a2,2,0,0,1,0,.36,2.19,2.19,0,1,1-2.19-2.08,2.27,2.27,0,0,1,.72.12V9.44h0a.36.36,0,0,0,.36-.36h0a.36.36,0,0,0-.36-.36h0a.35.35,0,0,0-.18.06,2.72,2.72,0,0,0-.52-.06A2.8,2.8,0,1,0,16,11.52h0Z"></path></g></g></g></svg>
                </span>
                    <span class="d-none d-md-inline-block">Обзор</span>
                </b-nav-item>
                <b-nav-item class="horizontal-nav-menu-item m-item" :to="{name:'blog'}" exact
                            exact-active-class="active">
                    <span class="menu-icon pr-md-3"><img class="icon-btn-md" src="/icons/svg/newspaper.svg"></span>
                    <span class="d-none d-md-inline-block">Статьи</span>
                </b-nav-item>
                <b-nav-item class="horizontal-nav-menu-item m-item"
                            :to="{name:'music'}"
                            exact
                            exact-active-class="active">
                <span class="menu-icon pr-md-3">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 12.29 16.21"><defs></defs><g><g
                        id="new_music_icon"><g><path
                        d="M6.37,16.21l.12,0H6.37ZM6.58.08h0L6.37,0V0h0a.4.4,0,0,0-.4.4V10.5a3.4,3.4,0,1,0,.81,2.91.39.39,0,0,0,.07-.21V1.12a7.6,7.6,0,0,1,3.26,2.74.39.39,0,0,0-.17,0,.4.4,0,1,0,.55.15l0,0,.63-.31A8.51,8.51,0,0,0,6.58.08ZM3.37,15.36a2.56,2.56,0,1,1,2.56-2.56A2.56,2.56,0,0,1,3.37,15.36ZM11.31,4.14V7c0,.23.08.46.09.7h.89A8.41,8.41,0,0,0,11.31,4.14Z"></path></g></g></g></svg>
                </span>
                    <span class="d-none d-md-inline-block">Музыка</span>
                </b-nav-item>
                <b-nav-item class="horizontal-nav-menu-item m-item"
                            :to="{name:'albums'}"
                            exact
                            exact-active-class="active">
                    <span class="menu-icon pr-md-3"><img class="icon-btn-md" src="/icons/svg/album.svg"></span>
                    <span class="d-none d-md-inline-block">Альбомы</span>
                </b-nav-item>
                <b-nav-item class="horizontal-nav-menu-item m-item"
                            :to="{name:'artists'}"
                            exact
                            exact-active-class="active">
                    <span class="menu-icon pr-md-3"><img class="icon-btn-md" src="/icons/svg/users.svg"></span>
                    <span class="d-none d-md-inline-block">Артисты</span>
                </b-nav-item>
                <b-nav-item class="horizontal-nav-menu-item m-item"
                            :to="{name:'clips'}"
                            exact
                            exact-active-class="active">
                    <span class="menu-icon pr-md-3"><img class="icon-btn-md" src="/icons/svg/video.svg"></span>
                    <span class="d-none d-md-inline-block">Клипы</span>
                </b-nav-item>
                <b-nav-item class="horizontal-nav-menu-item m-item"
                            :to="{name:'about'}"
                            exact
                            exact-active-class="active">
                    <span class="menu-icon pr-md-3"><img class="icon-btn-md" src="/icons/svg/info.svg"></span>
                    <span class="d-none d-md-inline-block">О нас</span>
                </b-nav-item>
            </ul>
            <hr class="border-hr" style="width: 159.66px; margin-left: 0px;">
        </div>

        <div class="py-5" style="padding-bottom:80px">
            <router-view></router-view>
        </div>
    </b-container>
</template>

<script>
    import PerfectScrollbar from 'perfect-scrollbar';
    import {movingBorder} from "../../../main";

    export default {
        name: "Home",
        mounted() {
            const container = document.querySelector('#horizontal-nav');
            const ps = new PerfectScrollbar(container, {useBothWheelAxes: true});
            movingBorder();
        }
    }
</script>

<style scoped>
    .horizontal-nav-wrapper {
        width: 100%;
        border-radius: 5px;
        background-color: transparent !important;
        position: relative;
    }

    .horizontal-scroll-list {
        display: flex;
        justify-content: space-between;
        flex-wrap: nowrap;
        list-style: none;
    }

    .horizontal-nav-menu-item {
        margin: 0;
        position: static;
        flex-basis: 0;
        flex-grow: 1;
        flex-wrap: nowrap;
        max-width: 100%;
        text-align: center;
        background: #343a40 !important;
        border-right: 1px solid #000;
        white-space: nowrap;
        font-size: 1.125rem;
        line-height: 1.6;
        color: #b8babc;
    }

    /*.horizontal-nav-menu-item:after {*/
    /*    content: '';*/
    /*    height: 50%;*/
    /*    width: 1px;*/
    /*}*/

    /*.horizontal-nav-menu-item .nav-link {*/
    /*    color: #b8babc !important*/
    /*}*/

    .horizontal-nav-menu-item a {
        padding: 1rem 2rem;
        position: relative;
        color: #b8babc;
        transition: color 0.2s ease;
        background-color: transparent;
        text-align: center;
        white-space: nowrap;
        font-size: 1.125rem;
    }

    .horizontal-nav-menu-item .active span {
        z-index: 2;
        color: #ffffff;
        position: relative;
        line-height: 0;
        display: inline-block;
        height: auto;
    }

    .horizontal-nav-menu-item .active:before {
        height: 100%;
        opacity: 1;
    }

    .horizontal-nav-menu-item .active :focus {
        outline: none;
    }

    .horizontal-nav-menu-item a::before {
        content: '';
        width: 100%;
        position: absolute;
        left: 0;
        top: 0;
        display: block;
        height: 0;
        opacity: 0;
        background: #91a5f4;
        background: linear-gradient(135deg, #91a5f4 0%, #b08cf9 86%);
        transition: all 0.4s ease-in-out;
    }

    .menu-icon {
        color: #fff;
        position: relative;
        z-index: 2;
        line-height: 0;
        display: inline-block;
        vertical-align: middle;
        height: auto;
        /*padding-right: 1rem !important;*/
    }

    .menu-icon svg {
        width: 20px;
        max-height: 22px;
        fill: currentColor;
        height: auto;
        overflow: hidden;
        color: #fff;
    }

    .moving-border {
        position: relative;
    }

    .moving-border .m-item {
        position: relative;
    }

    hr.border-hr {
        margin: 0;
        height: 3px;
        bottom: 0;
        border: 0;
        width: 0;
        position: absolute;
        transition: 0.3s ease-in-out;
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#91a5f4+0,b08cf9+86 */
        background: #91a5f4;
        /* Old browsers */
        background: -moz-linear-gradient(-45deg, #91a5f4 0%, #b08cf9 86%);
        /* FF3.6-15 */
        background: -webkit-linear-gradient(-45deg, #91a5f4 0%, #b08cf9 86%);
        /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(135deg, #91a5f4 0%, #b08cf9 86%);
        /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#91a5f4', endColorstr='#b08cf9', GradientType=1);
        /* IE6-9 fallback on horizontal gradient */
    }
</style>
