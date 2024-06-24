import { createStore } from "vuex";

const store = createStore({
    state: {
        token: localStorage.getItem("token") || "",
        user: localStorage.getItem("user") || null,
    },
    mutations: {
        setToken(state, token) {
            state.token = token;
            localStorage.setItem("token", token);
        },
        setUser(state, user) {
            state.user = user;
            localStorage.setItem("user", user);
        },
        clearAuth(state) {
            state.token = "";
            state.user = null;
            localStorage.removeItem("token");
        },
    },
    actions: {
        login({ commit }, { email, password }) {
            return axios
                .post("api/auth/login", { email, password })
                .then(({ data }) => {
                    console.log(data);
                    commit("setToken", data.access_token);
                    commit("setUser", data.user);
                    return data;
                });
        },
        logout({ commit }) {
            return axios.post("api/auth/logout").then(() => {
                commit("clearAuth");
            });
        },
    },
    getters: {
        isAuthenticated(state) {
            return !!state.token;
        },
        Name(state) {
            return state.user;
        },
    },
});

export default store;
