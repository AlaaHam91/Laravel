import Vuex from 'vuex';
import Vue from 'vue';
import auth from './modules/auth';
import forum from './modules/forum';
Vue.use(Vuex);

export default new Vuex.Store({
   modules:{
       auth,
       forum
   }
});
