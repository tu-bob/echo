import {fetchUser} from "../../api/authApi";

const state = {
    auth: {
        user: null
    }
};
const getters = {
    AUTHENTICATED: state => {
        return Boolean(state.auth.user)
    },
    AUTH_USER: state => {
        return state.auth.user
    }
};
const mutations = {
    SET_AUTH_USER: (state, payload) => {
        state.auth.user = payload;
    }
};
const actions = {
    LOG_IN: async (context, payload) => {
        return axios.post('/auth/login', {
            'email': payload.email,
            'password': payload.password
        })
            .then(response => {
                console.log(response)
                context.commit('SET_AUTH_USER', response)
            });
    },
    LOG_OUT: async (context, payload) => {
        return axios.post('/auth/logout')
            .then(_ => {
                context.commit('SET_AUTH_USER', null)
            });
    },
    FETCH_USER: async (context, payload) => {
        return fetchUser()
            .then(user => context.commit('SET_AUTH_USER', user))
            .catch(error => {
                context.commit('SET_AUTH_USER', null);
                return Promise.reject(error);
            })
    }
};

export default {
    state,
    getters,
    mutations,
    actions,
};
