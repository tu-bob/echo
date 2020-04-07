const state = {
    htmlErrors: []
};
const getters = {
        HTML_ERRORS: state => code => {
            if (code)
                return state.htmlErrors.filter(error => error.status === code);
            else
                return state.htmlErrors
        }
    }
;
const mutations = {
    ADD_HTML_ERROR: (state, error) => {
        state.htmlErrors.unshift(error);
    },
    RESET_HTML_ERRORS:(state) =>{
        state.htmlErrors = [];
    }
};
const actions = {};

export default {
    state,
    getters,
    mutations,
    actions,
};
