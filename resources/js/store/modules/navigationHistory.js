const state = {
    history: []
};
const getters = {
    PREV_ROUTE: state => state.history.length > 0 ? state.history[0] : null
}
;
const mutations = {
    PUSH_ROUTE_TO_HISTORY: (state, route) => {
        state.history.unshift(route);
    }
};
const actions = {};

export default {
    state,
    getters,
    mutations,
    actions,
};
