import {fetchUser} from "../../api/authApi";

const state = {
    mode: 'dark'
};
const getters = {
    NAV_TYPE: state => {
        return 'dark'
    },
    NAV_VARIANT: state => {
        return 'dark'
    },
    DROPDOWN_VARIANT: state => {
        return 'dark'
    },
    DEFAULT_BUTTON_CLASSES: state => {
        return {
            'btn':true,
            'btn-dark': true,
            'btn-text-white': true
        }
    },
    DROPDOWN_CLASSES: state => {
        return {};
    },
    DROPDOWN_ITEM_CLASSES: state => {
        return {};
    }
};
const mutations = {};
const actions = {};

export default {
    state,
    getters,
    mutations,
    actions,
};
