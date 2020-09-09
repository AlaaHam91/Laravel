import VueRouter from "vue-router";
import login from "../Pages/auth/login";
import Home from "../Pages/Home";
import welcome from "../Pages/welcome";
import Vue from "vue";
import guest from "../middlewares/guest";
import store from "../storage/index";
import checkAuth from "../middlewares/authcheck";
import auth from "../middlewares/auth";
import middlewarePipline from "../routes/middlewarePipline";
import register from "../Pages/auth/register";
import SingleDiscussion from '../Pages/SingleDiscussion';
import Discussions from '../Pages/Discussions';
Vue.use(VueRouter);
import Logout from '../Pages/auth/Logout';
import Notifications from "../Pages/Notifications";
//import SelectComp from "../Pages/SelectComp.vue";
const routes=[
  {
      path: "/login",
      name: "login",
      component: login,
        meta: { middleware: [guest] }
  },
  {
    path: "/logout",
    name: "logout",
    component: Logout

},
  {
      path: "/home",
      component: Home,

      children:[
      //  {path:"" ,component:Discussions,  name: "home"   , meta: { middleware: [auth, checkAuth] }},
        {path:"discussions/:channel/:discussion",component:SingleDiscussion,name:"discussion"}
      ]


  },
  { path: "/", name: "welcome", component: welcome },

 // { path: "/", name: "welcome", component: SelectComp },

  // // { path: "/register", name: "register", component: register },
  { path: '*', redirect: '/' },
  // { path: '/notifications', name: 'notifications',component:Notifications, meta: { middleware: [auth] }}

];


const router = new VueRouter({
    mode: "history",
    routes
});
//hocks   before every request
router.beforeEach((to, from, next) => {
    if (!to.meta.middleware) return next();
    const middleware = to.meta.middleware;
    const context = { to, from, next, store };
    return middleware[0]({
        ...context,
        next: middlewarePipline(context, middleware, 1)
    });
});
export default router;
