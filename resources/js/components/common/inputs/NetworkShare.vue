<template>
    <b-dropdown id="dropdown-1" variant="outline-dark" no-caret>
        <template v-slot:button-content>
            <font-awesome-icon icon="share" class="mr-1"></font-awesome-icon>
            Поделиться
        </template>
        <b-dropdown-item>
            <ShareNetwork
                network="facebook"
                :url="url"
                :title="title"
                :description="description"
                :quote="quote"
                :hashtags="hashTags"
            >
                <div class="d-flex aling-items-baseline">
                    <img class="icon-btn-sm mr-2" src="/icons/svg/facebook.svg">
                    Facebook
                </div>
            </ShareNetwork>
        </b-dropdown-item>
        <b-dropdown-item>
            <ShareNetwork
                network="vk"
                :url="url"
                :title="title"
                :description="description"
                :media="media"
            >
                <div class="d-flex aling-items-baseline">
                    <img class="icon-btn-sm mr-2" src="/icons/svg/vk.svg">
                    VK
                </div>
            </ShareNetwork>
        </b-dropdown-item>
        <b-dropdown-item>
            <ShareNetwork
                network="telegram"
                :url="url"
                :title="title"
                :description="description"
            >
                <div class="d-flex aling-items-baseline">
                    <img class="icon-btn-sm mr-2" src="/icons/svg/telegram.svg">
                    Telegram
                </div>
            </ShareNetwork>
        </b-dropdown-item>
        <b-dropdown-item>
            <ShareNetwork
                network="whatsapp"
                :url="url"
                :title="title"
                :description="description"
            >
                <div class="d-flex aling-items-baseline">
                    <img class="icon-btn-sm mr-2" src="/icons/svg/whatsapp.svg">
                    Whatsapp
                </div>
            </ShareNetwork>
        </b-dropdown-item>
        <b-dropdown-item>
            <ShareNetwork
                network="odnoklassniki"
                :url="url"
                :title="title"
            >
                <div class="d-flex aling-items-baseline">
                    <img class="icon-btn-sm mr-2" src="/icons/svg/odnoklassniki.svg">
                    Одноклассники
                </div>
            </ShareNetwork>
        </b-dropdown-item>
        <b-dropdown-item>
            <ShareNetwork
                network="viber"
                :url="url"
                :title="title"
                :description="description"
            >
                <div class="d-flex aling-items-baseline">
                    <img class="icon-btn-sm mr-2" src="/icons/svg/viber.svg">
                    Viber
                </div>
            </ShareNetwork>
        </b-dropdown-item>
    </b-dropdown>
</template>

<script>
    import {library} from '@fortawesome/fontawesome-svg-core'
    import {
        faShare
    } from '@fortawesome/free-solid-svg-icons'

    library.add(faShare);

    export default {
        name: "NetworkShare",
        props: {
            url: '',
            title: '',
            description: '',
            quote: '',
            hashTags: '',
            media: ''
        }
    }
</script>

<style scoped>

</style>
