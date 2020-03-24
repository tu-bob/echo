<template>

    <div class="container">
        <div class="w-100" style="width: 736px;">
            <div class="position-relative mb-5">
                <div class="img-box box-rounded-lg">
                    <img class="retina" src="../../../../img/browse-overview-1.jpg"
                         data-2x="../assets/images/playlists/browse-overview-1@2x.jpg" alt="">
                    <div class="hover-state">
                        <div class="absolute-center">
                                            <span class="pointer play-btn-dark  round-btn"><i
                                                class="play-icon"></i></span>
                        </div>
                    </div>
                </div>
                <div class="desc">
                    <p class="active-color-2 caps mb-1">New Album</p>
                    <h2 class="title h3-md"><a href="#">The
                        Ones That Like Me</a></h2>
                    <h5 class="sub-title"><a href="#">Danielle
                        Bradbery</a></h5>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "FeaturedCard",
        props: {
            image: {
                required: true,
                type: String
            },
            category: {
                type: String
            },
            title: {
                type: String
            },
            subtitle: {
                type: String
            },
            width: {
                type: String
            }
        }
    }
</script>
