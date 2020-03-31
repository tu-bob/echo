import {shuffle} from "../../util/array";

const state = {
    originalPlaylist: [],
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
    },
    SHUFFLE: (state, _) => {
        state.originalPlaylist = state.playlist.slice();
        state.playlist = shuffle(state.playlist.slice());
    },
    RESTORE_ORDER: (state, _) => {
        state.playlist = state.originalPlaylist.slice();
        state.originalPlaylist = [];
    },
};
const actions = {};

export default {
    state,
    getters,
    mutations,
    actions
};
