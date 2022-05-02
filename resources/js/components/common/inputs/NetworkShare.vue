<template>
    <div class="dropdown">
        <button class="btn btn-outline-secondary rounded-20 dropdown-toggle dropdown-toggle-no-caret"
                type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <font-awesome-icon icon="share" class="mr-1"></font-awesome-icon>
            Поделиться
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <div class="dropdown-item" style="        width: 178px !important;
        height: 31px !important;">
                <ShareNetwork
                    class="h-cursor"
                    network="facebook"
                    :url="url"
                    :title="title"
                    :description="description"
                    :quote="quote"
                    :hashtags="hashTags"
                >
                    <div class="d-flex align-items-center">
                        <img class="icon-btn-sm mr-2" src="/icons/svg/facebook.svg">
                        <span>Facebook</span>
                    </div>
                </ShareNetwork>
            </div>
            <div class="dropdown-item" style="        width: 178px !important;
        height: 31px !important;">
                <ShareNetwork
                    class="h-cursor"
                    network="vk"
                    :url="url"
                    :title="title"
                    :description="description"
                    :media="media"
                >
                    <div class="d-flex align-items-center">
                        <img class="icon-btn-sm mr-2" src="/icons/svg/vk.svg">
                       <span>VK</span>
                    </div>
                </ShareNetwork>
            </div>
            <div class="dropdown-item" style="        width: 178px !important;
        height: 31px !important;">
                <ShareNetwork
                    class="h-cursor"
                    network="telegram"
                    :url="url"
                    :title="title"
                    :description="description"
                >
                    <div class="d-flex align-items-center">
                        <img class="icon-btn-sm mr-2" src="/icons/svg/telegram.svg">
                        <span>Telegram</span>
                    </div>
                </ShareNetwork>
            </div>
            <div class="dropdown-item" style="        width: 178px !important;
        height: 31px !important;">
                <ShareNetwork
                    class="h-cursor"
                    network="whatsapp"
                    :url="url"
                    :title="title"
                    :description="description"
                >
                    <div class="d-flex align-items-center">
                        <img class="icon-btn-sm mr-2" src="/icons/svg/whatsapp.svg">
                        <span>Whatsapp</span>
                    </div>
                </ShareNetwork>
            </div>
            <div class="dropdown-item" style="        width: 178px !important;
        height: 31px !important;">
                <ShareNetwork
                    class="h-cursor"
                    network="odnoklassniki"
                    :url="url"
                    :title="title"
                >
                    <div class="d-flex align-items-center">
                        <img class="icon-btn-sm mr-2" src="/icons/svg/odnoklassniki.svg">
                        <span>Одноклассники</span>
                    </div>
                </ShareNetwork>
            </div>
            <div class="dropdown-item" style="        width: 178px !important;
        height: 31px !important;">
                <ShareNetwork
                    class="h-cursor"
                    network="viber"
                    :url="url"
                    :title="title"
                    :description="description"
                >
                    <div class="d-flex align-items-center">
                        <img class="icon-btn-sm mr-2" src="/icons/svg/viber.svg">
                        <span>Viber</span>
                    </div>
                </ShareNetwork>
            </div>
        </div>
    </div>
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
