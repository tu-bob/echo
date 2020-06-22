<template>
    <router-link class="text-decoration-none" :to="{name:'artist-view', params:{id:artist.aliases[0].id}}">
        <b-aspect aspect="1">
            <b-avatar  style="box-shadow: 7px 9px 13px 2px rgb(4, 4, 4);" :src="avatarUrl" variant="dark" class="w-100 h-100"></b-avatar>
        </b-aspect>
        <div class="text-center mt-3">
            <h4 class="typography-title text-secondary" v-if="artist.aliases && artist.aliases.length > 0">
                {{artist.aliases[0].name}}</h4>
        </div>
    </router-link>
</template>

<script>
    import {concatStrings} from "../../../util/stringHelper";
    import {getAvatarImage} from "../../../api/mediaApi";

    export default {
        name: "ArtistCard",
        props: {
            artist: null
        },
        computed: {
            // aliases() {
            //     return concatStrings(this.artist.aliases, ' ·');
            // },
            avatarUrl() {
                if (this.artist.avatar_id)
                    return getAvatarImage(this.artist.avatar_id);
            }
        },
    }
</script>

<style scoped>

</style>
