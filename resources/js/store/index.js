import Vue from 'vue';
import Vuex from 'vuex';
import auth from './modules/auth';
import ui from "./modules/ui";
import player from "./modules/player";
import navigationHistory from "./modules/navigationHistory";
import errors from "./modules/errors";

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {},
    getters: {},
    mutations: {},
    actions: {},
    modules: {
        auth,
        ui,
        player,
        navigationHistory,
        errors
    }
});
