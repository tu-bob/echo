const state = {
    auth: {
        user: null
    }
};
const getters = {
    AUTHENTICATED: state => {
        return Boolean(state.auth.user)
    }
};
const mutations = {
    SET_AUTH_USER: (state, payload) => {
        state.auth.user = payload;
    }
};
const actions = {
    LOG_IN: async (context, payload) => {
        axios.post('/auth/login', {
            'email': payload.email,
            'password': payload.password
        })
            .then(response => {
                context.commit('SET_AUTH_USER', response)
            });
    },
    LOG_OUT: async (context, payload) => {
        axios.post('/auth/logout')
            .then(_ => {
                context.commit('SET_AUTH_USER', null)
            });
    }
};

export default {
    state,
    getters,
    mutations,
    actions,
};
