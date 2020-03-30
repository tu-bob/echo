const state = {
    playlist: [],
    activeSong: null
};
const getters = {
    PLAYLIST: state => {
        return state.playlist;
    },
    ACTIVE_SONG: state => {
        return state.activeSong;
    },
};
const mutations = {
    SET_ACTIVE_SONG: (state, payload) => {
        state.activeSong = payload;
    },
    UPDATE_PLAYLIST: (state, payload) => {
        state.playlist = payload;
    }
};
const actions = {};

export default {
    state,
    getters,
    mutations,
    actions
};
