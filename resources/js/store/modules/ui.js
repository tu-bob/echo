import {fetchUser} from "../../api/authApi";

const state = {
    mode: 'dark'
};
const getters = {
    NAV_TYPE: state => {
        return state.mode
    },
    NAV_VARIANT: state => {
        return state.mode
    },
    AVATAR_VARIANT: state => {
        return 'secondary'
    },
    DROPDOWN_VARIANT: state => {
        return state.mode
    },
    DEFAULT_BUTTON_CLASSES: state => {
        return {
            'btn': true,
            'btn-dark': true,
            'btn-text-white': true
        }
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
