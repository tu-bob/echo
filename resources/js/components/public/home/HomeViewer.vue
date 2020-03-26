<template>
    <div class="container-fluid">
        <div id="horizontal-nav" class="horizontal-nav-wrapper scroll-x ps">
            <ul class="horizontal-scroll-list m-0 p-0 moving-border">
                <b-nav-item class="horizontal-nav-menu-item m-item" :to="{name:'overview'}" exact
                            exact-active-class="active">
                <span class="menu-icon">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 15"><defs></defs><g><g
                        id="overviews_icon" class="cls-1"><g
                        id="overviews_icon-2">
                        <path class="cls-2"
                              d="M16,1.4A1.43,1.43,0,0,0,14.55,0l-8,.7a1.43,1.43,0,0,0-1.45,1.4v7h0v2.78h0a2,2,0,0,1,0,.38,2.14,2.14,0,0,1-2.19,2.09,2.1,2.1,0,1,1,0-4.19,2.25,2.25,0,0,1,.72.13v-.13h0a.34.34,0,0,0,0-.69h0a.33.33,0,0,0-.18.06,2.75,2.75,0,0,0-.54-.06A2.85,2.85,0,0,0,0,12.22,2.85,2.85,0,0,0,2.91,15a2.85,2.85,0,0,0,2.91-2.78s0,0,0-.06h0V2.09a.71.71,0,0,1,.73-.7l8-.7a.71.71,0,0,1,.73.7v7h0v2.78h0a2,2,0,0,1,0,.36,2.19,2.19,0,1,1-2.19-2.08,2.27,2.27,0,0,1,.72.12V9.44h0a.36.36,0,0,0,.36-.36h0a.36.36,0,0,0-.36-.36h0a.35.35,0,0,0-.18.06,2.72,2.72,0,0,0-.52-.06A2.8,2.8,0,1,0,16,11.52h0Z"></path></g></g></g></svg></span>
                    <span class="">Обзор</span>
                </b-nav-item>
                <b-nav-item class="horizontal-nav-menu-item m-item" :to="{name:'news'}" exact
                            exact-active-class="active">
               <span class="menu-icon">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 455.005 455.005"><g><path
                        d="M446.158,267.615c-5.622-3.103-12.756-2.421-19.574,1.871l-125.947,79.309c-3.505,2.208-4.557,6.838-2.35,10.343 c2.208,3.505,6.838,4.557,10.343,2.35l125.947-79.309c2.66-1.675,4.116-1.552,4.331-1.432c0.218,0.12,1.096,1.285,1.096,4.428 c0,8.449-6.271,19.809-13.42,24.311l-122.099,76.885c-6.492,4.088-12.427,5.212-16.284,3.084c-3.856-2.129-6.067-7.75-6.067-15.423 c0-19.438,13.896-44.61,30.345-54.967l139.023-87.542c2.181-1.373,3.503-3.77,3.503-6.347s-1.323-4.974-3.503-6.347L184.368,50.615 c-2.442-1.538-5.551-1.538-7.993,0L35.66,139.223C15.664,151.815,0,180.188,0,203.818v4c0,23.63,15.664,52.004,35.66,64.595 l209.292,131.791c3.505,2.207,8.136,1.154,10.343-2.35c2.207-3.505,1.155-8.136-2.35-10.343L43.653,259.72 C28.121,249.941,15,226.172,15,207.818v-4c0-18.354,13.121-42.122,28.653-51.902l136.718-86.091l253.059,159.35l-128.944,81.196 c-20.945,13.189-37.352,42.909-37.352,67.661c0,13.495,4.907,23.636,13.818,28.555c3.579,1.976,7.526,2.956,11.709,2.956 c6.231,0,12.985-2.176,19.817-6.479l122.099-76.885c11.455-7.213,20.427-23.467,20.427-37.004 C455.004,277.119,451.78,270.719,446.158,267.615z"></path><path
                        d="M353.664,232.676c2.492,0,4.928-1.241,6.354-3.504c2.207-3.505,1.155-8.136-2.35-10.343l-173.3-109.126 c-3.506-2.207-8.136-1.154-10.343,2.35c-2.207,3.505-1.155,8.136,2.35,10.343l173.3,109.126 C350.916,232.303,352.298,232.676,353.664,232.676z"></path><path
                        d="M323.68,252.58c2.497,0,4.938-1.246,6.361-3.517c2.201-3.509,1.14-8.138-2.37-10.338L254.46,192.82 c-3.511-2.202-8.139-1.139-10.338,2.37c-2.201,3.51-1.14,8.138,2.37,10.338l73.211,45.905 C320.941,252.21,322.318,252.58,323.68,252.58z"></path><path
                        d="M223.903,212.559c-3.513-2.194-8.14-1.124-10.334,2.39c-2.194,3.514-1.124,8.14,2.39,10.334l73.773,46.062 c1.236,0.771,2.608,1.139,3.965,1.139c2.501,0,4.947-1.251,6.369-3.529c2.194-3.514,1.124-8.14-2.39-10.334L223.903,212.559z"></path><path
                        d="M145.209,129.33l-62.33,39.254c-2.187,1.377-3.511,3.783-3.503,6.368s1.345,4.983,3.54,6.348l74.335,46.219 c1.213,0.754,2.586,1.131,3.96,1.131c1.417,0,2.833-0.401,4.071-1.201l16.556-10.7c3.479-2.249,4.476-6.891,2.228-10.37 c-2.248-3.479-6.891-4.475-10.37-2.228l-12.562,8.119l-60.119-37.38l48.2-30.355l59.244,37.147l-6.907,4.464 c-3.479,2.249-4.476,6.891-2.228,10.37c2.249,3.479,6.894,4.476,10.37,2.228l16.8-10.859c2.153-1.392,3.446-3.787,3.429-6.351 c-0.018-2.563-1.344-4.94-3.516-6.302l-73.218-45.909C150.749,127.792,147.647,127.795,145.209,129.33z"></path><path
                        d="M270.089,288.846c2.187-3.518,1.109-8.142-2.409-10.329l-74.337-46.221c-3.518-2.188-8.143-1.109-10.329,2.409 c-2.187,3.518-1.109,8.142,2.409,10.329l74.337,46.221c1.232,0.767,2.601,1.132,3.953,1.132 C266.219,292.387,268.669,291.131,270.089,288.846z"></path><path
                        d="M53.527,192.864c-2.187,3.518-1.109,8.142,2.409,10.329l183.478,114.081c1.232,0.767,2.601,1.132,3.953,1.132 c2.506,0,4.956-1.256,6.376-3.541c2.187-3.518,1.109-8.142-2.409-10.329L63.856,190.455 C60.338,188.266,55.714,189.346,53.527,192.864z"></path></g></svg>               </span>
                    <span
                        class="">Новости</span>
                </b-nav-item>
                <b-nav-item class="horizontal-nav-menu-item m-item" :to="{name:'new-music'}" exact
                            exact-active-class="active">
                <span class="menu-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 12.29 16.21"><defs></defs><g><g
                        id="new_music_icon"><g><path
                        d="M6.37,16.21l.12,0H6.37ZM6.58.08h0L6.37,0V0h0a.4.4,0,0,0-.4.4V10.5a3.4,3.4,0,1,0,.81,2.91.39.39,0,0,0,.07-.21V1.12a7.6,7.6,0,0,1,3.26,2.74.39.39,0,0,0-.17,0,.4.4,0,1,0,.55.15l0,0,.63-.31A8.51,8.51,0,0,0,6.58.08ZM3.37,15.36a2.56,2.56,0,1,1,2.56-2.56A2.56,2.56,0,0,1,3.37,15.36ZM11.31,4.14V7c0,.23.08.46.09.7h.89A8.41,8.41,0,0,0,11.31,4.14Z"></path></g></g></g></svg>
                </span>
                    <span>Новинки</span>
                </b-nav-item>
            </ul>
            <hr class="border-hr" style="width: 159.66px; margin-left: 0px;">
        </div>


        <div class="py-5">
            <router-view></router-view>
        </div>
    </div>
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
        padding-right: 1rem !important;
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
