import {fetchUser} from "../../api/authApi";
import {commit} from "lodash/seq";

const state = {
    auth: {
        user: null,
        isAdmin: false
    }
};
const getters = {
    AUTHENTICATED: state => {
        return Boolean(state.auth.user)
    },
    AUTH_USER: state => {
        return state.auth.user
    },
    IS_ADMIN: state => {
        return state.auth.isAdmin;
    }
};
const mutations = {
    SET_AUTH_USER: (state, payload) => {
        state.auth.user = payload;
        state.auth.isAdmin = state.auth.user?.roles?.find(r => r.name === 'admin')
    },
    SET_IS_ADMIN: (state, payload) => {
        state.auth.isAdmin = payload
    }
};
const actions = {
    LOG_IN: async (context, payload) => {
        return axios.post('/auth/login', {
            'email': payload.email,
            'password': payload.password
        })
            .then(response => {
                context.commit('SET_AUTH_USER', response)
            });
    },
    LOG_OUT: async (context, payload) => {
        return axios.post('/auth/logout')
            .catch(e => Promise.reject(e))
            .then(_ => {
                context.commit('SET_AUTH_USER', null)
                context.commit('SET_IS_ADMIN', false)
            });
    },
    FETCH_USER: async (context, payload) => {
        return fetchUser()
            .then(user => context.commit('SET_AUTH_USER', user))
            .catch(e => {
                context.commit('SET_AUTH_USER', null);
                return Promise.reject(e);
            })
    },
};

export default {
    state,
    getters,
    mutations,
    actions,
};
