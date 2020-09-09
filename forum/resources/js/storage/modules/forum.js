import axios from "axios";

const state = {
    channels: [],
    discussions: [],
    discussion:null
  };
const getters = {
    channels: state => state.channels,
    discussions: state => state.discussions,
    discussion:sate=>state.discussion,
};

const mutations = {
    fetchChannelsSuccess(state, { channels }) {
        state.channels = channels;
    },
    fetchDiscussionsSuccess(state,{discussions}){
      state.discussions=discussions;
    },
    fetchDiscussionSuccess(state,{discussion}){
      state.discussion=discussion.data;
    }
};

const actions = {
    async fetchChannels({ commit }) {
        try {
            const { data } = await axios.get("/api/v1/channels");
            commit("fetchChannelsSuccess", { channels: data });
        } catch (err) {
        }
    },

    async fetchDiscussions({commit}){
        try{

          const {data}= await axios.get("/api/v1/discussions");
          commit("fetchDiscussionsSuccess",{discussions:data});

        }catch(err){
          console.log(err);
        }

    },

    async fetchDiscussion({commit},slug){
      try{

        const {data}= await axios.get(`/api/v1/discussions/${slug}`);
        commit("fetchDiscussionSuccess",{discussion:data});

      }catch(err){
        console.log(err);
      }

  },

    async storeDiscussion({ commit }, data) {
        try {
        //  console.log(data);
            await axios.post("/api/v1/discussions", data);
        } catch (error) {
        }
    },

    async storeReplay({ commit }, data) {
      try {
      //  console.log(data);
          await axios.post("/api/v1/replies", data);
      } catch (error) {
      }
  }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};
