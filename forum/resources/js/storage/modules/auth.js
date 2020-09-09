//all auth operation

import axios from "axios";
import Cookies from "js-cookie"; //to store the token
import * as types from "../mutations_types";

//state
const state = {
    user: null,
    token: Cookies.get("token"),
    auth_err: null,
    loading: false,
    isLogged: false,
    notifications:""
};

const getters = {
    user: state => state.user,
    token: state => state.token,
    check: state => state.isLogged,
    authError: state => state.auth_err,
    isLoading: state => state.loading,
    notifications:state=>state.notifications
};

const mutations = {
    [types.LOGIN](state) {
        state.loading = true;
        state.auth_err = null;
        state.isLogged = false;
    },

    // save_token(state,{})
    // [types.SAVE_TOKEN](state, { token, remmber }) {
    //     state.token = token;
    //     Cookies.set("token", token, { expires: remember ? 365 : null });
    // },

    [types.LOGIN_SUCCESS](state, { token, remember }) {
        state.loading = false;
        state.auth_err = null;
        state.token = token;
        state.isLogged = true;
        Cookies.set("token", token, { expires: remember ? 365 : null });
    },

    [types.LOGIN_FAILD](state, { error }) {
        state.loading = false;
        state.auth_err = error;
        state.isLogged = false;
    },

    [types.FETCH_USER_SUCCESS](state, {user} ) {
        state.user = user.data; //is the function user from the controller AuthController
        state.isLogged = true;
    },

    fetchNotificationsSuccess(state, {notifications} ) {
      state.notifications = notifications.data;
  },

    [types.FETCH_USER_FAILURE](state) {
        Cookies.remove("token");
        state.token = null;
        state.isLogged = false;
    },
    [types.LOGOUT](state) {
        Cookies.remove("token");
        state.user = null;
        state.token = null;
        state.isLogged = false;
    }
};

const actions = {
    login({ commit }) {
        commit(types.LOGIN);
    },
    async fetchUser({ commit }) {
        try {
            const{data}= await axios.get("/api/v1/auth/user");

            commit(types.FETCH_USER_SUCCESS, { user: data });

        } catch (error) {
           commit(types.FETCH_USER_FAILURE);
        }
    },

    async fetchNotifications({ commit }) {
      try {
          const{data}= await axios.get("/api/v1/auth/allNotifications");

          commit("fetchNotificationsSuccess", { notifications: data });

      } catch (error) {
      }
  }
};
export default {
    namespaced: true,
    state,
    actions,
    mutations,
    getters
};
