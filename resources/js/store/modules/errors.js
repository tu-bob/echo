const state = {
    htmlErrors: [],
    inaccessibleResources: []
};
const getters = {
        HTML_ERRORS: state => code => {
            if (code)
                return state.htmlErrors.filter(error => error.status === code);
            else
                return state.htmlErrors
        },
        IS_RESOURCE_INACCESSIBLE: state => resource => {
            return Boolean(state.inaccessibleResources.find(r => r === resource));
        }
    }
;
const mutations = {
    ADD_HTML_ERROR: (state, error) => {
        state.htmlErrors.unshift(error);
    },
    ADD_INACCESSIBLE_RESOURCE: (state, resource) => {
        state.inaccessibleResources.push(resource)
    },
    RESET_HTML_ERRORS: (state) => {
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
