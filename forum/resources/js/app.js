import Vue from "vue";
import router from "./routes/index";
import store from "./storage/index";
import VModal from "vue-js-modal";
import navbar from "../js/components/navbar";

Vue.use(VModal);
const app = new Vue({
    el: "#app",
    components:{
      navbar
    },
    router,
    store
})
export default app;
