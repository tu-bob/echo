<template>
    <router-link class="text-decoration-none" :to="{name:'artist-view', params:{id:artist.aliases[0].id}}">
        <b-aspect aspect="1">
            <b-avatar :src="avatarUrl" variant="dark" class="w-100 h-100"></b-avatar>
        </b-aspect>
        <div class="text-center mt-3">
            <h4 class="typography-title text-secondary" v-if="aliases && aliases.length > 0">
                {{aliases}}</h4>
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
            aliases() {
                return concatStrings(this.artist.aliases.map(alias => alias.name), ' ·');
            },
            avatarUrl() {
                if (this.artist.avatar_id)
                    return getAvatarImage(this.artist.avatar_id);
            }
        },
    }
</script>

<style scoped>

</style>
